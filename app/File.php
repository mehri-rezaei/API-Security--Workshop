<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class File extends Model
{
    protected $fillable = [
        'id',
        'file_type',
        'client_file_name',
        'path',
        'user_id',
        'servername'

    ];

    public function delete()
    {
        if (\Storage::exists($this->path)) {
            \Storage::delete($this->path);
        }

        return parent::delete();
    }

    

    public function setUrlAttribute($value)
    {
        $uris = explode('/', $value);
        $lastIndex = count($uris) - 1;
        $uris[$lastIndex] = rawurlencode($uris[$lastIndex]);

        $url = implode('/', $uris);

        $this->attributes['url'] = $url;
    }
}

