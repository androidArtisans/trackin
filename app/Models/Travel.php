<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'departure','device_id','route_id'];
    protected $with = ['device','route'];
    
    public function device()
    {
        return $this->belongsTo(Device::class,"device_id");
    }

    public function route()
    {
        return $this->belongsTo(Route::class,"route_id");
    }

    public function trakins()
    {
        return $this->hasMany(Trakin::class);
    }
}
