<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'employee_id',
        'name',
        'department',
        'gender',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate an employee ID based on the department.
     */
    public static function generateEmployeeId(string $department): string
    {
        $prefix = match ($department) {
            'Information Technology' => 'IT',
            'Human Resource' => 'HR',
            'Finance' => 'FIN',
            'Marketing' => 'MKT',
            'Sales' => 'SLS',
            'Operations' => 'OPS',
            'Engineering' => 'ENG',
            default => strtoupper(substr($department, 0, 3)),
        };

        $lastEmployee = static::where('employee_id', 'like', $prefix . '-%')
            ->orderBy('employee_id', 'desc')
            ->first();

        if ($lastEmployee) {
            $lastNumber = (int) substr($lastEmployee->employee_id, strlen($prefix) + 1);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . '-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }
}
