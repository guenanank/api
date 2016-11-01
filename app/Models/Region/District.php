<?php

namespace App\Models\Region;

class District extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'region';
    public $primaryKey = 'districtId';
    
    public function villages() {
        return $this->hasMany('\App\Models\Region\Village', 'villageId', 'villageId');
    }

}
