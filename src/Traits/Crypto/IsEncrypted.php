<?php

namespace Helvetiapps\LiveControls\Traits\Crypto;

use Illuminate\Support\Facades\Crypt;

trait IsEncrypted
{
    public string $encryptionPublic;

    public function createEncrypted(array $fields){
        $encryptedFields = [];
        foreach($fields as $key => $value){
            $encryptedFields[$key] = Crypt::encrypt($value);
        }

        return $this->create($encryptedFields);
    }

    public function updateEncrypted(array $fields){
        $encryptedFields = [];
        foreach($fields as $key => $value){
            $encryptedFields[$key] = Crypt::encrypt($value);
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