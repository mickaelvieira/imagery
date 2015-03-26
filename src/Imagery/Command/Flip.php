<?php

/*
 * This file is part of Imagery package
 *
 * (c) Mickaël Vieira <contact@mickael-vieira.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Imagery\Command;

use Imagery\Canvas;
use Imagery\Command;
use Imagery\Parameters\Parameters;

/**
 * Class Flip
 * @package Imagery\Command
 */
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
    public function execute(Canvas $canvas, Parameters $parameters = null)
    {
        $mode = $parameters->getByName('mode');

        if (is_null($mode)) {
            return $canvas;
        }

        $width  = $canvas->getWidth();
        $height = $canvas->getHeight();

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
            $canvas->getResource(),
            0,
            0,
            $srcX,
            $srcY,
            $width,
            $height,
            $srcWidth,
            $srcHeight
        );

        return $canvas->withResource($image);
    }
}
