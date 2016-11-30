<?php

namespace App\Models\Gateway;

class MediaGroup extends \Illuminate\Database\Eloquent\Model {

    protected $connection = 'gateway';
    protected $table = 'mediaGroups';
    public $primaryKey = 'mediaGroupId';
    protected $fillable = ['publisherId', 'mediaGroupCode', 'mediaGroupName', 'mediaGroupDesc'];

    public function media() {
        return $this->hasMany('\App\Models\Gateway\Media', 'mediaGroupId');
    }

    public function publisher() {
        return $this->belongsTo('\App\Models\Gateway\Publisher', 'publisherId');
    }

}
