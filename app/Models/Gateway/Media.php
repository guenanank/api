<?php

namespace App\Models\Gateway;

class Media extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'gateway';
    public $primaryKey = 'mediaId';

    public function mediaType() {
        return $this->hasOne('\App\Models\Gateway\MediaType', 'mediaTypeId', 'mediaTypeId');
    }

    public function mediaGroup() {
        return $this->hasOne('\App\Models\Gateway\MediaGroup', 'mediaGroupId', 'mediaGroupId');
    }

}
