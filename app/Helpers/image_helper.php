<?php

function uploadAndOptimizeImage($file, string $path, int $width = 800, int $quality = 80) {
    if (!$file || !$file->isValid() || $file->hasMoved()) {
        return null;
    }
    
    if (!is_dir($path)) {
        mkdir($path, 0775, true);
    }

    $imgData = file_get_contents($file->getTempName());
    $img = imagecreatefromstring($imgData);

    if (!$img) {
        return null;
    }

    $w = imagesx($img);
    $h = imagesy($img);

    $newH = intval(($h / $w) * $width);

    $tmp = imagecreatetruecolor($width, $newH);

    imagecopyresampled($tmp, $img, 0, 0, 0, 0, $width, $newH, $w, $h);

    $name = bin2hex(random_bytes(16)) . '.jpg';

    imagejpeg($tmp, rtrim($path, '/') . '/' . $name, $quality);

    imagedestroy($img);
    imagedestroy($tmp);
    
    return $name;
}