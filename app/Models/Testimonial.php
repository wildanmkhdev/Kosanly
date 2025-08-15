<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    //    //    use HasFactory;
    protected $fillable = [
        'boarding_house_id',
        'photo',
        'rating',
        'description',


    ];
    // kalau dai belongsto name function gak boleh jamak atua pakai s
    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class);
    }
}
