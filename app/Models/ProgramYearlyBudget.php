<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramYearlyBudget extends Model
{
    use HasFactory;
    protected $table = 'program_yearly_budgets';
    protected $primaryKey = 'yearly_budget_id';

    protected $fillable = [
        'employee_id',
        'program_id',
        'budget_code',
        'yearly_budget',
        'remaining_budget',
        'year',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function quarterlyBudgets()
    {
        return $this->hasMany(ProgramQuarterlyBudget::class, 'yearly_budget_id');
    }
}
