<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Vaccine extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'barangay_id',
        'vaccines_name',
        'brand_name',
        'has_dose',
    ];

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    public function child_vaccine()
    {
        return $this->hasMany(ChildVaccine::class);
    }

    public function toSearchableArray(){
        return [
            'vaccines_name' => $this->vaccines_name,
        ];
    }
}
