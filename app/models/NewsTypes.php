<?php

use Illuminate\Database\Eloquent\Model;

class NewsTypes extends Model
{
    //
    protected $table = 'news_types';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

}
