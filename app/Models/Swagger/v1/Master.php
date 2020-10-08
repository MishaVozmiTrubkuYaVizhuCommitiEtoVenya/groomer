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
        'client_id',
    ];
    protected $hidden = [
        'password',
        'remember_token',
        'client_id',
        'email',
        'email_verified_at'
    ];

    public function client()
    {
        return $this->belongsTo('\App\Models\Swagger\V1\Client');
    }

    public function workingDiapasons(){
        return $this->hasMany('\App\Model\Swagger\V1\WorkingDiapason');
    }
}
