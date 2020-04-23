<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * @var string
     */
    protected $table = 'clients';

    /**
     * @var array
     */
    protected $fillable = [
        'client',
    ];

}
