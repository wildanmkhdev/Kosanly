<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Bonus extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'boarding_house_id',
        'image',
        'name',
        'description',


    ];
    // kalau dai belongsto name function gak boleh jamak atua pakai s
    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class);
    }
}
