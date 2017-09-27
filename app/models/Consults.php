<?php

use Illuminate\Database\Eloquent\Model;

class Consults extends Model
{
    //
    protected $table = 'consults';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
}
