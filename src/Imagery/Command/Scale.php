<?php


namespace Imagery\Command;


use Imagery\Command;
use Imagery\Options;

final class Scale implements Command
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
        $scale = $options->get('scale', 100);

        $srcWidth  = imagesx($resource);
        $srcHeight = imagesy($resource);

        $width  = $srcWidth * $scale / 100;
        $height = $srcHeight * $scale / 100;

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
            $srcWidth,
            $srcHeight
        );

        return $image;
    }
}
