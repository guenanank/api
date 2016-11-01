<?php

namespace App\Models\Region;

class GreaterArea extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'region';
    public $primaryKey = 'greaterAreaId';

    public function regencies() {
        return $this->hasMany('\App\Models\Region\Regency', 'greaterAreaId', 'greaterAreaId');
    }
    
}
