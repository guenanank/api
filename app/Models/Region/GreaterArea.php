<?php

namespace App\Models\Region;
use Illuminate\Database\Eloquent\Model;

class GreaterArea extends Model {

    protected $connection = 'region';
    protected $table = 'greaterAreas';
    public $primaryKey = 'greaterAreaId';
    protected $fillable = ['greaterAreaName'];

    public static function rules($rules = []) {
        return array_merge($rules, ['greaterAreaName' => 'required|string|max:127|unique:region.greaterAreas']);
    }

    public function regencies() {
        return $this->hasMany('\App\Models\Region\Regency', 'greaterAreaId', 'greaterAreaId');
    }

}
