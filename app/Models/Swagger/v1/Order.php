<?php

namespace App\Models\Swagger\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ["working_diapazon_start_id", "working_diapazon_end_id", "pet_id", "phone", "pet_name", "owner_name"];
}
