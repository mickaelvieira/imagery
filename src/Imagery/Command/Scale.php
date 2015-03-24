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
 * Class Scale
 * @package Imagery\Command
 */
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
        $scale = $options->get('scale');

        if (is_null($scale)) {
            return $resource;
        }

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
