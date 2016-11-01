<?php

namespace App\Models\Vehicle;

class Series extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'vehicle';
    public $primaryKey = 'seriesId';

    public function brand() {
        return $this->hasOne('\App\Models\Vehicle\Brand', 'brandId', 'brandId');
    }

    public function classification() {
        return $this->hasOne('\App\Models\Vehicle\Classification', 'classificationId', 'classificationId');
    }

}
