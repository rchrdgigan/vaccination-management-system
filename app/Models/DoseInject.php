<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoseInject extends Model
{
    use HasFactory;

    protected $fillable = [
        'barangay_id',
        'child_vaccine_id',
        'dose',
        'has_inj',
        'inj_date',
        'reason',
        'status',
    ];

    public function child_vaccine()
    {
        return $this->belongsTo(ChildVaccine::class);
    }

}
