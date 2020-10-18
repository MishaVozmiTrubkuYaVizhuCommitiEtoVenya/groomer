<?php

namespace App\Models\Swagger\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingDiapason extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ["time_start", "state"];

    public function getTimeStartAttribute($value){
        return strtotime($value);
    }

    public function master()
    {
        return $this->belongsTo('\App\Models\Swagger\V1\Master');
    }
}
