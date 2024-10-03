{{-- <!DOCTYPE html>
<html>
<head>
    <title>Budget Request Approval Needed</title>
</head>
<body>
    <h1>Budget Request Approval Needed</h1>
    <p>Dear {{ $nextApprover->full_name }},</p>
    <p>A budget request has been submitted, and your approval is required.</p>
    <p><strong>Request ID:</strong> {{ $requestBudget->request_budget_id }}</p>
    <p><strong>Budget:</strong> {{ $requestBudget->budget }}</p>
    <p><strong>Total Cost:</strong> {{ $totalAll }}</p>
    <p><strong>Current Stage:</strong> {{ $currentStage }}</p>

    <p>Please review the request at your earliest convenience. A detailed report is attached.</p>
    <p>Thank you.</p>
</body>
</html> --}}


<!DOCTYPE html>
<html>

    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 20px;
            }

            .email-container {
                background-color: #ffffff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                max-width: 600px;
                margin: auto;
                text-align: left;
            }

            .logo {
                text-align: left;
                margin-top: -24px;
                margin-bottom: 20px;

            }

            .logo img {
                max-width: 220px;
            }

            h3 {
                color: #333;
                text-align: center;
            }

            p,
            ul {
                color: #555;
            }

            ul {
                padding-left: 20px;
                margin: 0;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            td {
                padding: 8px 0;
                vertical-align: top;
                font-size: 16px;
            }

            .label {
                width: 30%;
                font-weight: bold;
            }

            .value {
                width: 70%;
            }

            .alert {
                position: relative;
                padding: 5px 5px;
                margin-bottom: 1px;
                border: 1px solid transparent;
                border-radius: 0.20rem;
                font-size: 12px !important;

            }

            .alert-primary {
                color: #084298;
                background-color: #cfe2ff;
                border-color: #084298;
            }

            .alert-secondary {
                color: #41464b;
                background-color: #e2e3e5;
                border-color: #41464b;
            }

            .alert-success {
                color: #0f5132;
                background-color: #d1e7dd;
                border-color: #0f5132;
            }

            .alert-danger {
                color: #842029;
                background-color: #f8d7da;
                border-color: #842029;
            }

            .alert-warning {
                color: #664d03;
                background-color: #fff3cd;
                border-color: #664d03;
            }

            .alert-info {
                color: #055160;
                background-color: #cff4fc;
                border-color: #055160;
            }

            .alert-light {
                color: #636464;
                background-color: #fefefe;
                border-color: #636464;
            }

            .alert-dark {
                color: #141619;
                background-color: #d3d3d4;
                border-color: #141619;
            }

            .button-report {
                right: 0;
                color: #ffff !important;
                border-radius: 6px;
                background-color: #4a25aa;
                border: none;
                text-align: center;
                text-decoration: none;
                font: 400 16px Narasi Sans, sans-serif;
                align-self: center;
                padding: 10px 14px;
                margin-top: 12px;
                display: block;
            }
        </style>
    </head>

    <body>
        <div style="background-color: #f9f9f9; padding-top: 64px; padding-bottom: 64px;">
            <div class="logo container" style="text-align: center">
                <img src="https://imgur.com/GYooEjc.png" alt="Company Logo" style="display: inline-block;">
            </div>
            <div class="email-container">
                <h3>Dear {{ strtoupper($nextApprover->full_name) }}, </h3>
                <h3>{{ strtoupper($requestBudget->employee->full_name) }} needs your approval to request budget.</h3>
                <h4>Request Budget detail:</h4>
                <table>
                    <tr>
                        <td class="label">Status</td>
                        {{-- <td>: <span class="alert alert-success">{{ strtoupper($currentStage) }}</span></td> --}}
                        <td>: <span class="alert alert-success">PENDING</span></td>
                    </tr>
                    <tr>
                        <td class="label">User</td>
                        <td>: {{ $requestBudget->employee->full_name }}</td>
                    </tr>
                    <tr>
                        <td class="label">Date of Production</td>
                        <td>: {{ $requestBudget->date_start }}</td>
                    </tr>
                    <tr>
                        <td class="label">Budget Code</td>
                        <td>: {{ $requestBudget->budget_code }}</td>
                    </tr>
                    <tr>
                        <td class="label">Episode Name</td>
                        <td>: {{ $requestBudget->episode }}</td>
                    </tr>
                    <tr>
                        <td class="label">Requested Date</td>
                        <td>: {{ $requestBudget->created_at->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Production Type</td>
                        <td>: {{ $requestBudget->type }}</td>
                    </tr>
                    <tr>
                        <td class="label">Program Name</td>
                        <td>: {{ strtoupper($requestBudget->program->program_name) }}</td>
                    </tr>
                    <tr>
                        <td class="label">Total Budget</td>
                        <td>: Rp. {{ number_format($totalAll, 2, ',', '.') }}</td>
                    </tr>
                </table>
                <h3><a href="{{ url('/approval/' . $requestBudget->request_budget_id) }}" class="button-report">Process
                        Approval</a></h3>
                <div>
                </div>
            </div>
        </div>

    </body>

</html>
