<?php

namespace App\Models\Gateway;

class Media extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'gateway';
    public $primaryKey = 'mediaId';

    public function mediaType() {
        return $this->belongsTo('\App\Models\Gateway\MediaType', 'mediaTypeId');
    }

    public function mediaGroup() {
        return $this->belongsTo('\App\Models\Gateway\MediaGroup', 'mediaGroupId');
    }

}
