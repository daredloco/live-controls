<?php

namespace Helvetiapps\LiveControls\Traits\Crypto;

use Illuminate\Support\Facades\Crypt;

trait IsEncrypted
{
    public string $encryptionPublic;

    public static function createEncrypted(array $fields, array $ignoredFields = []){
        $encryptedFields = [];
        foreach($fields as $key => $value){
            $encryptedFields[$key] = in_array($key, $ignoredFields) ? $value : Crypt::encrypt($value);
        }

        return static::create($encryptedFields);
    }

    public function updateEncrypted(array $fields, array $ignoredFields = []){
        $encryptedFields = [];
        foreach($fields as $key => $value){
            $encryptedFields[$key] = in_array($key, $ignoredFields) ? $value : Crypt::encrypt($value);
        }

        return $this->update($encryptedFields);
    }

    public function decrypt(string ...$fields):array|string{
        $decryptedFields = [];

        //If only one field is set, return a string
        if(count($fields) == 1){
            return Crypt::decrypt($this->{$fields});
        }

        //If more than one field is set, return an array
        foreach($fields as $field){
            $decryptedFields[$field] = Crypt::decrypt($this->{$field});
        }

        return $decryptedFields;
    }
}