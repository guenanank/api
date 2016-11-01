<?php

namespace App\Models\Gateway;

class Position extends \Illuminate\Database\Eloquent\Model {
    
    protected $connection = 'gateway';
    public $primaryKey = 'positionId';
    
    public function employees() {
        return $this->hasMany('\App\Models\Gateway\Employee', 'positionId');
    }
    
}