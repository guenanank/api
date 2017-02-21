<?php

namespace App\Models\Vehicle;

class Series extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'vehicle';
    public $primaryKey = 'seriesId';
    protected $fillable = ['classificationId', 'brandId', 'seriesName'];

    public static function rules($rules = []) {
        return array_merge($rules, [
            'classificationId' => 'required|exists:vehicle.classification,classificationId',
            'brandId' => 'required|exists:vehicle.brand,brandId',
            'seriesName' => 'required|string|max:127',
        ]);
    }

    public function brand() {
        return $this->hasOne('\App\Models\Vehicle\Brand', 'brandId', 'brandId');
    }

    public function classification() {
        return $this->hasOne('\App\Models\Vehicle\Classification', 'classificationId', 'classificationId');
    }

}
