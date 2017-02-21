<?php

namespace App\Models\Vehicle;

class Type extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'vehicle';
    public $primaryKey = 'typeId';
    protected $fillable = ['seriesId', 'typeName', 'typeYear', 'typeCc'];

    public static function rules($rules = []) {
        return array_merge($rules, [
            'seriesId' => 'required|exists:vehicle.series,seriesId',
            'typeName' => 'required|string|max:127',
            'typeYear' => 'string|max:9999',
            'typeCc' => 'numeric',
        ]);
    }

    public function series() {
        return $this->hasOne('\App\Models\Vehicle\Series', 'seriesId', 'seriesId');
    }

}
