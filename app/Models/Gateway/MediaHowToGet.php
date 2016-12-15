<?php

namespace App\Models\Gateway;

class MediaHowToGet extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'gateway';
    protected $table = 'mediaHowToGets';
    public $primaryKey = 'mediaHowToGetId';

}
