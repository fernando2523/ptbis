<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hourmeter extends Model
{
    use HasFactory;

    protected $table = "hourmeters";

    // public function vehicle()
    // {
    //     return $this->belongsTo(Vehicle::class);
    // }
}
