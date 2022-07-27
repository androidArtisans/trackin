<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trakin extends Model
{
    use HasFactory;
    protected $fillable = ['register_point_date','message_type','message','latitude','longitude','travel_id'];
    protected $with = ['travel'];

    public function travel()
    {
        return $this->belongsTo(Travel::class,"travel_id");
    }
}
