<?php

namespace App\Models\Swagger\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        "working_diapason_start_id",
        "working_diapason_end_id",
        "pet_id",
        "phone",
        "pet_name",
        "owner_name"
    ];

    public function services() : Relation {
        return $this->belongsToMany('\App\Models\Swagger\v1\Service', 'order_services');
    }
}
