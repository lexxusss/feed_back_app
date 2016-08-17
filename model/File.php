<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 16.08.16
 * Time: 19:37
 */

namespace model;


class File
{
    private static $errors = [];
    private static $filePath = null;

    public static $rules = [
        'width' => 320,
        'height' => 240,
        'content_types' => [
            IMAGETYPE_PNG => 'imagepng',
            IMAGETYPE_JPEG => 'imagejpeg',
            IMAGETYPE_GIF => 'imagegif'
        ]
    ];

    public static function upload($file)
    {
        if (!empty($file['error']['image'])) {
            self::$errors['image'] = 'There was an error during uploading file: ' . $file['error']['image'];

            return false;
        }

        $fileSize = getimagesize($file['tmp_name']['image']);
        $fileType = exif_imagetype($file['tmp_name']['image']);
        if (!array_key_exists($fileType, self::$rules['content_types'])) {
            self::$errors['image'] = 'File type is not valid';

            return false;
        }

        $uploadPath = '/src/uploads/';
        $fileName = bin2hex(mcrypt_create_iv(6, MCRYPT_DEV_URANDOM)) . '.png';
        $uploadPath .= $fileName;

        if ($fileSize[0] < self::$rules['width'] || $fileSize[1] > self::$rules['height']) {
            $src = imagecreatefromstring(file_get_contents($file['tmp_name']['image']));
            $dst = imagecreatetruecolor(self::$rules['width'], self::$rules['height']);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, self::$rules['width'], self::$rules['height'], $fileSize[0], $fileSize[1]);
            imagedestroy($src);
            $saveFunction = self::$rules['content_types'][$fileType];
            $saveFunction($dst, getcwd() . $uploadPath);
            imagedestroy($dst);

            self::$filePath = $uploadPath;

            return true;
        }

        self::$filePath = $uploadPath;
        
        return move_uploaded_file($file['tmp_name']['image'], getcwd() . $uploadPath);
    }

    public static function getErrors()
    {
        return self::$errors;
    }

    public static function getFilePath()
    {
        return self::$filePath;
    }
}
