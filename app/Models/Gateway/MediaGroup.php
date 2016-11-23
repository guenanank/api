<?php

namespace App\Models\Gateway;

class MediaGroup extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'gateway';
    protected $table = 'mediaGroups';
    public $primaryKey = 'mediaGroupId';

    public function media() {
        return $this->belongsTo('\App\Models\Gateway\Media', 'mediaId', 'mediaId');
    }

}
