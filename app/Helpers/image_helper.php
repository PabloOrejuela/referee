<?php

function uploadAndOptimizeImage($file, string $path, int $width = 800, int $quality = 80) {
    if (
        !$file
        || !$file->isValid()
        || $file->hasMoved()
        || $width < 1
        || !function_exists('imagecreatefromstring')
        || !function_exists('imagejpeg')
    ) {
        return null;
    }

    // El modo solicitado se aplica al crear el directorio, sujeto al umask del hosting.
    // Si ya existe, la aplicación no cambia su propietario ni sus permisos.
    if (!is_dir($path) && !@mkdir($path, 0775, true) && !is_dir($path)) {
        return null;
    }

    if (!is_writable($path)) {
        return null;
    }

    $imgData = @file_get_contents($file->getTempName());
    if ($imgData === false) {
        return null;
    }

    $img = @imagecreatefromstring($imgData);
    if (!$img instanceof \GdImage) {
        return null;
    }

    $originalWidth = imagesx($img);
    $originalHeight = imagesy($img);
    if ($originalWidth < 1 || $originalHeight < 1) {
        imagedestroy($img);
        return null;
    }

    // No agrandar fotos pequeñas; solo reducirlas hasta el ancho máximo.
    $newWidth = min($width, $originalWidth);
    $newHeight = max(1, (int) round(($originalHeight / $originalWidth) * $newWidth));
    $output = imagecreatetruecolor($newWidth, $newHeight);
    if (!$output) {
        imagedestroy($img);
        return null;
    }

    imagecopyresampled(
        $output,
        $img,
        0,
        0,
        0,
        0,
        $newWidth,
        $newHeight,
        $originalWidth,
        $originalHeight
    );

    // 30 caracteres hexadecimales + ".jpg" = 34, cabe en VARCHAR(35).
    $name = bin2hex(random_bytes(15)) . '.jpg';
    $destination = rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $name;

    try {
        $saved = @imagejpeg($output, $destination, max(0, min(100, $quality)));
    } catch (\Throwable $exception) {
        $saved = false;
    }

    imagedestroy($img);
    imagedestroy($output);

    if (!$saved) {
        if (is_file($destination)) {
            @unlink($destination);
        }

        return null;
    }

    return $name;
}
