<?php

namespace App\Models\Swagger\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        "title",
        "text",
        "url",
        "image",
        "date_start",
        "date_end"
    ];



    public function getDateStartAttribute($value){
        return strtotime($value);
    }

    public function client()
    {
        return $this->belongsTo('\App\Models\Swagger\V1\Client');
    }
}
