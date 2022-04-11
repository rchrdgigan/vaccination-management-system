<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
class Child extends Model
{
    use HasFactory, Searchable;

    // protected $fillable = [
    //     'barangay_id',
    //     'date_of_registration',
    //     'date_of_birth',
    //     'place_of_birth',
    //     'childs_name',
    //     'gender',
    //     'mothers_name',
    //     'fathers_name',
    //     'birth_height',
    //     'birth_weight',
    // ];
    protected $guarded=[];

    public function barangay()
    {
        return $this->belongsTo(Barangay::class, 'barangay_id');
    }

    public function child_vaccine()
    {
        return $this->hasMany(ChildVaccine::class);
    }

    public function toSearchableArray(){
        return [
            'childs_name' => $this->childs_name
        ];
    }
}
