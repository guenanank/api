<?php

namespace App\Models\Gateway;

class MediaCategory extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'gateway';
    protected $table = 'mediaCategories';
    public $primaryKey = 'mediaCategoryId';

}
