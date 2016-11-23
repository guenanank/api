<?php

namespace App\Models\Region;

class Regency extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'region';
    public $primaryKey = 'regencyId';
    protected $fillable = ['provinceId', 'greaterAreaId', 'regencyName'];

    public static function boot() {
        parent::boot();

        static::creating(function($model) {
            foreach ($model->attributes as $key => $value) {
                $model->{$key} = empty($value) ? null : $value;
            }
        });

        static::updating(function($model) {
            foreach ($model->attributes as $key => $value) {
                $model->{$key} = empty($value) ? null : $value;
            }
        });
    }

    public static function rules($rules = []) {
        return array_merge($rules, [
            'provinceId' => 'exists:region.provinces,provinceId',
            'greaterAreaId' => 'exists:region.greaterAreas,greaterAreaId',
            'regencyName' => 'required|string|max:127|unique:region.regencies'
        ]);
    }

    public function districts() {
        return $this->hasMany('\App\Models\Region\District', 'regencyId', 'regencyId');
    }

}
