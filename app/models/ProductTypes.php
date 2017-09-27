<?php

use Illuminate\Database\Eloquent\Model;

class ProductTypes extends Model
{
    //
    protected $table = 'product_types';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
}
