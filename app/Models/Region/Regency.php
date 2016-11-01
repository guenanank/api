<?php

namespace App\Models\Region;

class Regency extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'region';
    public $primaryKey = 'regencyId';

    public function districts() {
        return $this->hasMany('\App\Models\Region\District', 'regencyId', 'regencyId');
    }
}
