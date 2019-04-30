<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //The table name is normally the plural of the class name all in small case letters. Define it if otherwise.
    //protected $table = 'posts';
    //When the primary key name is different to ID you need to come here and define it.
    //protected $primaryKey = "id";

    protected $fillable = [
        'title',
        'content'
    ];
}
