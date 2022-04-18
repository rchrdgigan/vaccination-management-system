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
        'inj_1st_date',
        'inj_2nd_date',
        'inj_3rd_date',
        'has_inj_1st_dose',
        'has_inj_2nd_dose',
        'has_inj_3rd_dose',
    ];

    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class);
    }

    public function child()
    {
        return $this->belongsTo(Child::class);
    }

}
