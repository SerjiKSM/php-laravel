<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @var array
     */
    protected $fillable = [
        'product', 'total', 'date', 'client_id'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'client_id' => 'integer',
        'date' => 'datetime',
    ];

    public function client(){
        return $this->belongsTo(Client::class, 'client_id');
    }
}
