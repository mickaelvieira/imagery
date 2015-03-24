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
 * Class Resize
 * @package Imagery\Command
 */
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
