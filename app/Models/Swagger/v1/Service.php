<?php

namespace App\Models\Swagger\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ["name", "image", "text"];
    public function client()
    {
        return $this->belongsTo('\App\Models\Swagger\V1\Client');
    }
}
