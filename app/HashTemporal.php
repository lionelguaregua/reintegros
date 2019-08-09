<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HashTemporal extends Model
{
    //
    protected $connection = 'mysql2';

    protected $table = 'ruta_hash_temporal';

    protected $fillable = ['voucher','hash'];
}
