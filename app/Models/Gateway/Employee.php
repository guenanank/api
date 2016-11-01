<?php

namespace App\Models\Gateway;

class Employee extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'gateway';
    public $primaryKey = 'employeeId';
    protected $fillable = ['token'];
    protected $hidden = ['password', 'token'];

    public function section() {
        return $this->belongsTo('\App\Models\Gateway\Section', 'sectionId');
    }

    public function position() {
        return $this->belongsTo('\App\Models\Gateway\Position', 'positionId');
    }

}
