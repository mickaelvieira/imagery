<?php


namespace Imagery\Command;


use Imagery\Command;
use Imagery\Options;

final class Resize implements Command
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
        $width  = $options->get('width');
        $height = $options->get('height');

        $srcWidth  = imagesx($resource);
        $srcHeight = imagesy($resource);

        if (!is_null($width) && is_null($height)) {
            $ratio  = $width / $srcWidth;
            $height = $srcHeight * $ratio;
        } elseif (is_null($width) && !is_null($height)) {
            $ratio = $srcHeight;
            $width = $srcWidth * $ratio;
        } else {
            $width  = $srcWidth;
            $height = $srcHeight;
        }

        $image = imagecreatetruecolor($width, $height);

        imagecopyresampled(
            $image,
            $resource,
            0,
            0,
            0,
            0,
            $width,
            $height,
            imagesx($resource),
            imagesy($resource)
        );

        return $image;
    }
}
