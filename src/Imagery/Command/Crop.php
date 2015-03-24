<?php


namespace Imagery\Command;


use Imagery\Command;
use Imagery\Options;

final class Crop implements Command
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
        $srcWidth  = imagesx($resource);
        $srcHeight = imagesx($resource);

        $width  = $options->get('width', $srcWidth);
        $height = $options->get('height', $srcHeight);

        $srcX = ($srcWidth / 2) - ($width / 2);
        $srcY = ($srcHeight / 2) - ($height / 2);

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
            $width,
            $height
        );

        return $image;
    }
}
