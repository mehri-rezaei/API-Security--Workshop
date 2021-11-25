<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class FileType extends Model
{
    const VIDEO = 'video';
    const SUBTITLE = 'subtitle';
    const THUMBNAIL = 'thumbnail';
    const WATERMARK = 'watermark';
    const AUDIO = 'audio';

    public static function getMimeTypes(string $fileType)
    {
        switch ($fileType) {
            case FileType::SUBTITLE:
                return ['text/plain'];
                break;
            case FileType::THUMBNAIL:
                return ['image/png', 'image/jpeg'];
                break;
            case FileType::VIDEO:
                return ['video/mp4', 'video/avi', 'video/x-m4v', 'video/3gpp'];
                break;
            case FileType::WATERMARK:
                return ['image/png', 'image/jpeg', 'image/gif'];
                break;
            case FileType::AUDIO:
                return ['audio/mp3', 'audio/wav', 'audio/mpeg',
                    'audio/m4a', 'audio/x-m4a', 'application/octet-stream'];
                break;
            default:
                [];
                break;
        }
    }

    public static function hashName($type)
    {
        $hashName = Str::random(40);

        $extension = '';

        switch ($type) {
            case self::THUMBNAIL:
                $extension = '.png';
                break;
            case self::VIDEO:
                $extension = '.mp4';
                break;
            case self::AUDIO:
                $extension = '.mp4';
                break;
        }

        return $hashName.$extension;
    }
}
