<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    use HasFactory;

    protected $fillable = [
        'barangay_id',
        'vaccines_name',
        'has_1st_dose',
        'has_2nd_dose',
        'has_3nd_dose',
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