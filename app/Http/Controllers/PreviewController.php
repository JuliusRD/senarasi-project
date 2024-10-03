<?php

namespace App\Http\Controllers;

use App\models\Employee;
use App\Models\Performer;
use App\Models\ProductionCrew;
use App\Models\ProductionTool;
use App\Models\Location;
use App\Models\Operational;
use App\Models\RequestBudget;
use App\Models\SubDescription;
use App\Models\Approval;
use App\Models\History;
use App\Models\TotalCost;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestBudgetProgram\ManagerNotificationMail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PreviewController extends Controller
{
    public function create()
    {
        $employee = Employee::pluck('full_name', 'employee_id');
        $subdescription = SubDescription::pluck('sub_description_name', 'sub_description_id');
        return view('requestbudget.preview', compact('employee', 'subdescription'));
    }

    public function store(Request $request)
    {
        // $approverIds = [
        //     'manager' => $request->input('manager_id'), // Example: Employee ID for manager
        //     'reviewer' => '3', // Example: Employee ID for reviewer
        //     'hc' => '7', // Example: Employee ID for the new approver after reviewer
        //     'finance 1' => '5', // Employee ID for finance 1
        // ];

        // // If budget is less than or equal to 200 million, add approval 3
        // if ($request->input('budget') >= 200000000) {
        //     $approverIds['finance 2'] = '6'; // Example: Employee ID for approval 3
        // }

        // // Create approval stages
        // foreach ($approverIds as $stage => $employeeId) {
        //     // Validate stage to prevent check constraint violation
        //     if (!in_array($stage, ['manager', 'reviewer', 'hc', 'finance 1', 'finance 2'])) {
        //         continue; // Skip invalid stages
        //     }

        //     Approval::create([
        //         'request_budget_id' => $request->input('request_budget_id'),
        //         'employee_id' => $employeeId,
        //         'stage' => $stage,
        //         'status' => 'pending',
        //         // Add other fields as needed
        //     ]);
        // }

        // $validateData = $request->validate([
        //     'employee_id' => 'required|exists:employees,employee_id',
        //     'request_budget_id' => 'required|exists:request_budgets,request_budget_id',
        //     'history_status' => 'required|string|max:255'
        // ]);

        // // Create the history
        // History::create($validateData);

        // return redirect()->route('request-budget.index')->with('success', 'Budget request submitted successfully.');

        $requestBudget = RequestBudget::find($request->input('request_budget_id'));

        $isResubmission = false;

        // Check if this is a resubmission by looking for any rejected approvals
        if ($requestBudget) {
            $hasRejected = $requestBudget->approval->contains('status', 'rejected');

            if ($hasRejected) {
                $isResubmission = true;

                foreach ($requestBudget->approval as $approval) {
                    $approval->status = 'pending';
                    $approval->reason = []; // Reset reason
                    $approval->save();
                }

                History::create([
                    'request_budget_id' => $requestBudget->request_budget_id,
                    'employee_id' => $request->user()->employee_id,
                    'history_status' => 'resubmitted',
                ]);
            }
        }

        // Process the initial submission if no budget request exists or if it's not a resubmission
        $approverIds = [
            'manager' => $request->input('manager_id'), // Example: Employee ID for manager
            'reviewer' => '3', // Example: Employee ID for reviewer
            'hc' => '7', // Example: Employee ID for the new approver after reviewer
            'finance 1' => '5', // Employee ID for finance 1
        ];

        // If the budget is greater than or equal to 200 million, add finance 2
        if ($request->input('budget') >= 200000000) {
            $approverIds['finance 2'] = '6'; // Employee ID for finance 2
        }

        // Create approval stages
        foreach ($approverIds as $stage => $employeeId) {
            // Validate stage to prevent check constraint violation
            if (!in_array($stage, ['manager', 'reviewer', 'hc', 'finance 1', 'finance 2'])) {
                continue; // Skip invalid stages
            }

            // Create the approval record only if it doesn't already exist (initial submission)
            $existingApproval = $requestBudget ? $requestBudget->approval->where('stage', $stage)->first() : null;
            if (!$existingApproval) {
                Approval::create([
                    'request_budget_id' => $request->input('request_budget_id'),
                    'employee_id' => $employeeId,
                    'stage' => $stage,
                    'status' => 'pending',
                    'reason' => [], // Set the initial reason to an empty array
                ]);
            }
        }

        // Validate the request data for history creation
        $validateData = $request->validate([
            'employee_id' => 'required|exists:employees,employee_id',
            'request_budget_id' => 'required|exists:request_budgets,request_budget_id',
            'history_status' => 'required|string|max:255'
        ]);

        // Create the history for the initial submission or resubmission
        History::create($validateData);

        // Generate the PDF report (you can reuse the report function logic)
        $pdf = $this->report($requestBudget->request_budget_id)->output(); // Get the PDF output

        // Get the total cost and current stage for the email
        $totalAll = $this->calculateTotalCost($requestBudget->request_budget_id); // This function should calculate the total cost like in your report
        $currentStage = $this->getCurrentStage($requestBudget); // Get the current stage for this request

        // Send email notification to the manager with the report attached
        $manager = Employee::find($request->input('manager_id'));

        if ($manager && $manager->email) {
            Mail::to($manager->email)->send(new ManagerNotificationMail(
                $requestBudget,
                $isResubmission,
                $pdf, // Attach the PDF report
                $totalAll, // Include the total cost
                $currentStage // Include the current stage information
            ));
        }

        return redirect()->route('request-budget.index')->with('success', 'Budget request submitted successfully.');
    }

    public function report($id)
    {
        $requestbudget = RequestBudget::findOrFail($id);
        // Fetch and group performers by sub_description_id
        $performer = Performer::with(['subDescription', 'employee'])
            ->where('request_budget_id', $id)
            ->get()
            ->groupBy('sub_description_id');

        // Calculate the number of NCS and OUT entries for each sub_description_id
        $repPerformerCounts = $performer->map(function ($group) {
            return [
                'NCS' => $group->where('rep', 'NCS')->count(),
                'OUT' => $group->where('rep', 'OUT')->count(),
            ];
        });

        // Calculate the total NCS and OUT across all sub_description_id
        $totalRepPerformerCounts = $repPerformerCounts->reduce(function ($carry, $item) {
            return [
                'NCS' => $carry['NCS'] + $item['NCS'],
                'OUT' => $carry['OUT'] + $item['OUT'],
            ];
        }, ['NCS' => 0, 'OUT' => 0]);

        // Calculate the total cost for performers
        $totalPerformerCost = $performer->map(function ($group) {
            return $group->sum('total_cost');
        })->sum();

        // Fetch and group production crews by sub_description_id
        $productioncrew = ProductionCrew::with(['subDescription', 'employee'])
            ->where('request_budget_id', $id)
            ->get()
            ->groupBy('sub_description_id');

        // Calculate the number of NCS and OUT entries for each sub_description_id
        $repCrewCounts = $productioncrew->map(function ($group) {
            return [
                'NCS' => $group->where('rep', 'NCS')->count(),
                'OUT' => $group->where('rep', 'OUT')->count(),
            ];
        });

        // Calculate the total NCS and OUT across all sub_description_id
        $totalRepCrewCounts = $repCrewCounts->reduce(function ($carry, $item) {
            return [
                'NCS' => $carry['NCS'] + $item['NCS'],
                'OUT' => $carry['OUT'] + $item['OUT'],
            ];
        }, ['NCS' => 0, 'OUT' => 0]);

        // Calculate total costs
        $totalcost = TotalCost::where('request_budget_id', $id)->first();
        $totalperformer = $totalcost ? $totalcost->total_performers_cost : 0;
        $totalproductioncrew = $totalcost ? $totalcost->total_production_crews_cost : 0;
        $totalproductiontool = $totalcost ? $totalcost->total_production_tools_cost : 0;
        $totaloperational = $totalcost ? $totalcost->total_operationals_cost : 0;
        $totallocation = $totalcost ? $totalcost->total_locations_cost : 0;
        $totalAll = $totalperformer + $totalproductioncrew + $totalproductiontool + $totaloperational + $totallocation;

        // Fetch and group production tools by sub_description_id
        $productiontool = ProductionTool::with(['subDescription', 'employee'])
            ->where('request_budget_id', $id)
            ->get()
            ->groupBy('sub_description_id');

        // Fetch and group operational by sub_description_id
        $operational = Operational::with(['subDescription', 'employee'])
            ->where('request_budget_id', $id)
            ->get()
            ->groupBy('sub_description_id');

        // Fetch and group location by sub_description_id
        $location = Location::with(['subDescription', 'employee'])
            ->where('request_budget_id', $id)
            ->get()
            ->groupBy('sub_description_id');

        // Total cost of all categories
        $approval1 = Employee::findOrFail(120017081704);
        $approval2 = Employee::findOrFail(120021071261);
        $reviewer = Employee::findOrFail(220017110117);
        $hc = Employee::findOrFail(220017110117);
        // Generate the PDF (but do not stream it)
        $pdf = Pdf::loadView('report.view', [
            'budget' => $requestbudget->budget,
            'approval1' => $approval1,
            'approval2' => $approval2,
            'reviewer' => $reviewer,
            'hc' => $hc,
            'requestbudget' => $requestbudget,
            'performer' => $performer,
            'productioncrew' => $productioncrew,
            'productiontool' => $productiontool,
            'operational' => $operational,
            'location' => $location,
            'totalAll' => $totalAll,
            'totalRepCrewCounts' => $totalRepCrewCounts,
            'totalRepPerformerCounts' => $totalRepPerformerCounts,
        ]);

        // Set the paper format
        $pdf->setPaper('LEGAL', 'landscape');

        // Return the PDF object (not streaming)
        return $pdf;
    }

    private function calculateTotalCost($id)
    {
        $totalcost = TotalCost::where('request_budget_id', $id)->first();
        $totalperformer = $totalcost ? $totalcost->total_performers_cost : 0;
        $totalproductioncrew = $totalcost ? $totalcost->total_production_crews_cost : 0;
        $totalproductiontool = $totalcost ? $totalcost->total_production_tools_cost : 0;
        $totaloperational = $totalcost ? $totalcost->total_operationals_cost : 0;
        $totallocation = $totalcost ? $totalcost->total_locations_cost : 0;
        return $totalperformer + $totalproductioncrew + $totalproductiontool + $totaloperational + $totallocation;
    }

    private function getCurrentStage($requestBudget)
    {
        // Determine the current stage based on the approval status
        $pendingApproval = $requestBudget->approval->where('status', 'pending')->first();
        return $pendingApproval ? $pendingApproval->status : 'completed';
    }
}
