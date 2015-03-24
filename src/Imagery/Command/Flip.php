<?php


namespace Imagery\Command;


use Imagery\Command;
use Imagery\Options;

final class Flip implements Command
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return strtolower(end(explode("\\", __CLASS__)));
    }

    /**
     * {@inheritdoc}
     */
    public function execute($resource, Options $options = null)
    {
        $mode = $options->get('mode');

        if (is_null($mode)) {
            return $resource;
        }

        $width  = imagesx($resource);
        $height = imagesy($resource);

        $srcX = 0;
        $srcY = 0;
        $srcWidth = $width;
        $srcHeight = $height;

        if ($mode === IMG_FLIP_VERTICAL) { // 2 - vertical
            $srcY      = $height - 1;
            $srcHeight = -$height;
        } elseif ($mode === IMG_FLIP_HORIZONTAL) { // 1 - horizontal
            $srcX     = $width - 1;
            $srcWidth = -$width;
        } elseif ($mode === IMG_FLIP_BOTH) { // 3 - both
            $srcX = $width - 1;
            $srcY = $height - 1;
            $srcWidth = -$width;
            $srcHeight = -$height;
        }

        $image = imagecreatetruecolor($width, $height);

        imagecopyresampled(
            $image,
            $resource,
            0,
            0,
            $srcX,
            $srcY,
            $width,
            $height,
            $srcWidth,
            $srcHeight
        );

        return $image;
    }
}
