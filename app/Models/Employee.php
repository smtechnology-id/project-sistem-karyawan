<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = ['user_id', 'work_unit_id', 'nama', 'alamat', 'no_hp'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workUnit()
    {
        return $this->belongsTo(WorkUnit::class);
    }
}
