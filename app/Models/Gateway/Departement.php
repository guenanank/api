<?php

namespace App\Models\Gateway;

class Departement extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'gateway';
    public $primaryKey = 'departementId';
    
    public function sections() {
        return $this->hasMany('\App\Models\Gateway\Section', 'departementId');
    }

    public function division() {
        return $this->belongsTo('\App\Models\Gateway\Division', 'divisionId');
    }
}
