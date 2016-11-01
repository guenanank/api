<?php

namespace App\Models\Vehicle;

class Type extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'vehicle';
    public $primaryKey = 'typeId';

    public function series() {
        return $this->hasOne('\App\Models\Vehicle\Series', 'seriesId', 'seriesId');
    }

}
