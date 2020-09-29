<?php

namespace App\Models\Swagger\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Master extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasApiTokens;

    public $timestamps = false;
    protected $fillable = [
        "name",
        "image",
        "description",
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
