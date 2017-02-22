<?php

namespace App\Models\Gateway;

class Media extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'gateway';
    public $primaryKey = 'mediaId';

    public function mediaCategory() {
        return $this->belongsTo('\App\Models\Gateway\MediaCategory', 'mediaCategoryId');
    }

    public function mediaGroup() {
        return $this->belongsTo('\App\Models\Gateway\MediaGroup', 'mediaGroupId');
    }

}
