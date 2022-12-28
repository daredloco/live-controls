<?php

namespace Helvetiapps\LiveControls\Models\Crypto;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class EncryptedModel extends Model
{
    protected $table;
    
    public function create(array $attributes = [], array $ignoredFields = [], array $options = []){
        $encAttributes = [];
        foreach($attributes as $field => $attribute){
            array_push($encAttributes, in_array($field, $ignoredFields) ? $attribute : Crypt::encrypt($attribute));
        }
        parent::__construct($encAttributes);
        parent::save($options);
    }

    public function update(array $attributes = [], array $ignoredFields = [], array $options = []){
        $encAttributes = [];
        foreach($attributes as $field => $attribute){
            array_push($encAttributes, in_array($field, $ignoredFields) ? $attribute : Crypt::encrypt($attribute));
        }
        parent::update($encAttributes, $options);
    }
}