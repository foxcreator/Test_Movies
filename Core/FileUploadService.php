<?php

namespace Core;

class FileUploadService
{
    public function uploadImage($image)
    {
        $tempPath = $image['tmp_name'];

        $extention = pathinfo($image['name'], PATHINFO_EXTENSION);
        $imageName = date('Y-m-d H:i:s') . rand() . '.' . $extention;

        $pathDb = 'img/' . $imageName;
        $path = ASSET_DIR . $pathDb;

        if ($image['error'] === 0) {
            move_uploaded_file($tempPath, $path);
        } else {
            throw new \Exception('File not upload. Error: ' . $image['error']);
        }

        return $pathDb;
    }

    public function deleteFile($name):bool
    {
        $path = ASSET_DIR . $name;
        if (file_exists($path)) {
            unlink($path);
        }

        return true;
    }


}