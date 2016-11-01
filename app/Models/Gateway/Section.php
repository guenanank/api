<?php

namespace App\Models\Gateway;

class Section extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'gateway';
    public $primaryKey = 'sectionId';
    
    public function employees() {
        return $this->hasMany('\App\Models\Gateway\Employee', 'sectionId');
    }
    
    public function departement() {
        return $this->belongsTo('\App\Models\Gateway\Departement', 'departementId');
    }

}
