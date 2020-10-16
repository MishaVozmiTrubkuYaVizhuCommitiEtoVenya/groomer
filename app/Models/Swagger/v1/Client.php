<?php

namespace App\Models\Swagger\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Client extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasApiTokens;

    public $timestamps = false;
    protected $fillable = [
        "type",
        "name",
        "image",
        "settings",
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'email',
        'email_verified_at'
    ];

    public function masters(){
        return $this->hasMany('\App\Models\Swagger\v1\Master');
    }

    public function promotions(){
        return $this->hasMany('\App\Models\Swagger\v1\Promotion');
    }

    public function services(){
        return $this->hasMany('\App\Models\Swagger\v1\Service');
    }
}
