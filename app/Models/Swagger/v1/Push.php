<?php

namespace App\Models\Swagger\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Push extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        "text",
        "title",
        "icon",
        'sound',
        "description",
        "platform",
        "date",
        "device_token"
    ];

    public function getDeviceToken()
    {
        return $this->deviceToken;
    }
}
