<?php

namespace App\Models\Gateway;

class Publisher extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'gateway';
    public $primaryKey = 'publisherId';
    protected $fillable = ['publisherCode', 'publisherName', 'publisherDesc'];

    public function mediaGroups() {
        return $this->hasMany('\App\Models\Gateway\MediaGroup', 'publisherId');
    }

}
