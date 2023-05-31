<?php

namespace App\Model\Manager;

use SpaceQuiz\Manager;


class FileManager extends Manager
{
    public function upload($file, $width = 300, $height = 300): string
    {

        //! Vérifier si le champ "name=" existe
        //! Si les autres champs du formulaire sont remplis
        if (isset($file) && !empty($file)) {
            $fileType = array_keys($file)[0];
            $settings = [
                'allowed_extensions' => ['jpg', 'png', 'jpeg', 'gif'],
                'max_size' => 10000000
            ];
            //! Récupère le nom / extension de l'image + la mets en minuscule
            $imageParts = explode('.', $file[$fileType]['name']);
            $extension = strtolower(end($imageParts));
            //! Vérification de l'extension, de la taille et de l'absence d'erreur pour l'image
            if (
                in_array($extension, $settings['allowed_extensions']) &&
                $file[$fileType]['size'] <= $settings['max_size'] &&
                $file[$fileType]['error'] == 0
            ) {
                // Avoir un nom unique de fichier pour l'image
                $uniqueImage = uniqid('', true) . '.' . $extension;

                // Définir le dossier d'uploads pour toutes les images
                $uploadsDir = './public/img/uploads/';

                //! Déplace l'image 1 dans le dossier 'uploads'
                move_uploaded_file($file[$fileType]['tmp_name'], $uploadsDir . $uniqueImage);

                // pic crop + pic resize (use GD library)
                switch ($extension) {
                    case 'gif':
                        $im = imagecreatefromgif($uploadsDir . $uniqueImage);
                        break;
                    case 'jpg':
                        $im = imagecreatefromjpeg($uploadsDir . $uniqueImage);
                        break;
                    case 'jpeg':
                        $im = imagecreatefromjpeg($uploadsDir . $uniqueImage);
                        break;
                    case 'png':
                        $picSizeOrigin = getimagesize($uploadsDir . $uniqueImage);
                        $im = imagecreatetruecolor($picSizeOrigin[0], $picSizeOrigin[1]);
                        $white = imagecolorallocate($im, 255, 255, 255);
                        imagefill($im, 0, 0, $white);
                        $png = imagecreatefrompng($uploadsDir . $uniqueImage);
                        imagealphablending($png, true);
                        imagesavealpha($png, true);
                        imagecopy($im, $png, 0, 0, 0, 0, $picSizeOrigin[0], $picSizeOrigin[1]);
                        imagedestroy($png);
                        break;
                }

                $size = min(imagesx($im), imagesy($im));
                $centerX = round(imagesx($im) / 2);
                $centerY = round(imagesy($im) / 2);
                $im2 = imagecrop($im, ['x' => $centerX - round($size / 2), 'y' => $centerY - round($size / 2), 'width' => $size, 'height' => $size]);
                if ($im2 !== FALSE) {
                    $oldw = $oldh = $size;
                    $temp = imagecreatetruecolor($width, $height);
                    imagecopyresampled($temp, $im2, 0, 0, 0, 0, $width, $height, $oldw, $oldh);
                    imagejpeg($temp, $uploadsDir . $uniqueImage);
                    imagedestroy($temp);
                    imagedestroy($im2);
                }
                imagedestroy($im);
                // End of pic crop & resize



                //! On renvoit le nom de l'image pour le transmettre au manager
                return $uploadsDir . $uniqueImage;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
}