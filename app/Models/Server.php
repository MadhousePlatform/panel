<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Server extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    protected $fillable = [
        'uuid', 'name', 'description',
        'user_id', 'ip_address', 'port',
        'additional_ports', 'memory', 'disk'
    ];

    protected $casts = [
        'additional_ports' => Json::class,
    ];

}
