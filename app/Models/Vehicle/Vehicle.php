<?php

namespace App\Models\Vehicle;

class Vehicle extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'vehicle';
    public $primaryKey = 'vehicleId';

    public function type() {
        return $this->hasOne('\App\Models\Vehicle\Type', 'typeId', 'typeId');
    }
}
