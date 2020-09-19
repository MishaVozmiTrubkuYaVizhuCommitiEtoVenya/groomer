<?php

namespace App\Models\Swagger\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingDiapazon extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ["size", "time_start", "state"];
}
