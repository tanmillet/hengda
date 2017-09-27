<?php

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    protected $table = 'products';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
}
