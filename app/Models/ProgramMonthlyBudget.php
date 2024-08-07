<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramMonthlyBudget extends Model
{
    use HasFactory;
    protected $table = 'program_monthly_budgets';
    protected $primaryKey = 'monthly_budget_id';

    protected $fillable = [
        'quarterly_budget_id',
        'employee_id',
        'program_id',
        'budget_code',
        'month',
        'monthly_budget',
        'remaining_budget',
    ];

    public function quarterlyBudget()
    {
        return $this->belongsTo(ProgramQuarterlyBudget::class, 'quarterly_budget_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
}
