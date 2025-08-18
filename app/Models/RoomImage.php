<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomImage extends Model
{
    //
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'room_id',
        'image',


    ];
    // kalau dai belongsto name function gak boleh jamak atua pakai s
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
