<?php

namespace App\Models\Swagger\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingDiapason extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ["size", "time_start", "state"];

    public function master()
    {
        return $this->belongsTo('\App\Models\Swagger\V1\Master');
    }
}
