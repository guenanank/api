<?php

namespace App\Models\Vehicle;

class Brand extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'vehicle';
    public $primaryKey = 'brandId';

    public function series() {
        return $this->belongsTo('\App\Models\Vehicle\Series', 'brandId', 'brandId');
    }

}
