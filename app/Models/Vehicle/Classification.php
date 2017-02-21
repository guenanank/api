<?php

namespace App\Models\Vehicle;

class Classification extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'vehicle';
    protected $table = 'classifications';
    public $primaryKey = 'classificationId';
    protected $fillable = ['classificationName', 'classificationDesc'];

    public static function rules($rules = []) {
        return array_merge($rules, [
            'classificationName' => 'required|string|max:127|unique:vehicle.classification',
            'classificationDesc' => 'max:225'
        ]);
    }

    public function series() {
        return $this->belongsTo('\App\Models\Vehicle\Series', 'seriesId', 'seriesId');
    }

}
