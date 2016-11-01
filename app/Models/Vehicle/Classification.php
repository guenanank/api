<?php

namespace App\Models\Vehicle;

class Classification extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'vehicle';
    public $primaryKey = 'classificationId';

    public function series() {
        return $this->belongsTo('\App\Models\Vehicle\Series', 'seriesId', 'seriesId');
    }

}
