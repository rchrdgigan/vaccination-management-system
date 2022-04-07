<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    use HasFactory;

    protected $fillable = [
        'barangay_name',
    ];

    public function child()
    {
        return $this->hasMany(Child::class);
    }

    public function vaccine()
    {
        return $this->hasMany(Vaccine::class);
    }
}
