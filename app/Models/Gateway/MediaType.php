<?php

namespace App\Models\Gateway;

class MediaType extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'gateway';
    protected $table = 'mediaTypes';
    public $primaryKey = 'mediaTypeId';

    public function media() {
        return $this->belongsTo('\App\Models\Gateway\Media', 'mediaId', 'mediaId');
    }

}
