<?php

/*
 * This file is part of CollectionJson, a php implementation
 * of the Collection+JSON Media Type
 *
 * (c) Mickaël Vieira <contact@mickael-vieira.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Imagery\Command;

use Imagery\Command;
use Imagery\Options;

/**
 * Class Crop
 * @package Imagery\Command
 */
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
