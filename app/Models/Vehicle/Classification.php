<?php

namespace App\Models\Vehicle;

class Classification extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'vehicle';
    public $primaryKey = 'classificationId';
    protected $fillable = ['classificationName', 'classificationDesc'];

    public static function rules($rules = []) {
        return array_merge($rules, [
            'classificationName' => 'required|string|max:127|unique:vehicle.' . self::table,
            'classificationDesc' => 'max:225'
        ]);
    }

    public function series() {
        return $this->belongsTo('\App\Models\Vehicle\Series', 'seriesId', 'seriesId');
    }

}
