<?php

namespace App\Models\Gateway;

class Division extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'gateway';
    public $primaryKey = 'divisionId';
    
    public function departements() {
        return $this->hasMany('\App\Models\Gateway\Departement', 'divisionId');
    }

    
}
