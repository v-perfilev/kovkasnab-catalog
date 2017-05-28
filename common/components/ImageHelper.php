<?php

namespace common\components;

class ImageHelper
{

    static function prepare_image($image, $w_o, $h_o)
    {
        list($w_i, $h_i) = getimagesize($image);
        if( $w_i/$h_i > $w_o/$h_o )
        {
            ImageHelper::resize($image, false, $h_o);
            list($w_i, $h_i) = getimagesize($image);
            ImageHelper::crop($image, ($w_i-$w_o)/2, 0, $w_o, $h_o);
        }
        else
        {
            ImageHelper::resize($image, $w_o, false);
            list($w_i, $h_i) = getimagesize($image);
            ImageHelper::crop($image, 0, ($h_i-$h_o)/2, $w_o, $h_o);
        }

        return true;
    }

    // Обрезка изображения
    static function crop($image, $x_o, $y_o, $w_o, $h_o)
    {

        list($w_i, $h_i, $type) = getimagesize($image);
        $types = array("", "gif", "jpeg", "png");
        $ext = $types[$type];

        $func = 'imagecreatefrom' . $ext;
        $img_i = $func($image);

        if ($x_o + $w_o > $w_i) $w_o = $w_i - $x_o;
        if ($y_o + $h_o > $h_i) $h_o = $h_i - $y_o;

        $img_o = imagecreatetruecolor($w_o, $h_o);
        imagealphablending($img_o, false);
        imagesavealpha($img_o, true);
        imagecopy($img_o, $img_i, 0, 0, $x_o, $y_o, $w_o, $h_o);

        $func = 'image' . $ext;
        return $func($img_o, $image);
    }

    // Масштабирование изображения
    static function resize($image, $w_o = false, $h_o = false) {

        list($w_i, $h_i, $type) = getimagesize($image);
        $types = array("", "gif", "jpeg", "png");
        $ext = $types[$type];

        $func = 'imagecreatefrom' . $ext;
        $img_i = $func($image);

        if (!$h_o) $h_o = $w_o / ($w_i / $h_i);
        if (!$w_o) $w_o = $h_o / ($h_i / $w_i);

        $img_o = imagecreatetruecolor($w_o, $h_o);
        imagealphablending($img_o, false);
        imagesavealpha($img_o, true);
        imagecopyresampled($img_o, $img_i, 0, 0, 0, 0, $w_o, $h_o, $w_i, $h_i);

        $func = 'image'.$ext;
        return $func($img_o, $image);
    }

}