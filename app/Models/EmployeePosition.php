<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePosition extends Model
{
    use HasFactory;

    protected $table = 'employee_positions';

    protected $fillable = ['user_id', 'position_id'];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
