<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Task extends Eloquent
{
    protected $connection = 'mongodb';
    protected $fillable = ['name'];
}
