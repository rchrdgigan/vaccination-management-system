<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'barangay_id',
        'date_of_registration',
        'date_of_birth',
        'place_of_birth',
        'childs_name',
        'gender',
        'mothers_name',
        'fathers_name',
        'birth_height',
        'birth_weight',
    ];

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    public function child_vaccine()
    {
        return $this->hasMany(ChildVaccine::class);
    }
}
