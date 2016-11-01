<?php

namespace App\Models\Region;

class Province extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'region';
    public $primaryKey = 'provinceId';

    public function regencies() {
        return $this->hasMany('\App\Models\Region\Regency', 'provinceId', 'provinceId');
    }
    
}
