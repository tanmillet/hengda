<?php

use Illuminate\Database\Eloquent\Model;

class SeoInfo extends Model
{
    //
    protected $table = 'seo';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
}
