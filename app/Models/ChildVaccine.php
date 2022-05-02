<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildVaccine extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'vaccine_id',
        'barangay_id'
    ];

    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class);
    }

    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    public function dose_inject()
    {
        return $this->hasMany(DoseInject::class);
    }
}
