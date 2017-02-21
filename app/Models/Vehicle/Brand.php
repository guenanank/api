<?php

namespace App\Models\Vehicle;

class Brand extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'vehicle';
    public $primaryKey = 'brandId';
    protected $fillable = ['brandName'];

    public static function rules($rules = []) {
        return array_merge($rules, [
            'brandName' => 'required|string|max:127|unique:vehicle.' . $this->table(),
        ]);
    }

    public function series() {
        return $this->belongsTo('\App\Models\Vehicle\Series', 'brandId', 'brandId');
    }

}
