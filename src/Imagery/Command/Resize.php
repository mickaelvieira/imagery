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

use Imagery\Canvas;
use Imagery\Command;
use Imagery\Parameters;

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
    public function execute(Canvas $canvas, Parameters $parameters = null)
    {
        $destWidth  = $parameters->get('width');
        $destHeight = $parameters->get('height');

        if (is_null($destWidth) && is_null($destHeight)) {
            return $canvas;
        }

        $srcWidth  = $canvas->getWidth();
        $srcHeight = $canvas->getHeight();

        if (!is_null($destWidth) && is_null($destHeight)) {
            $ratio = $destWidth / $srcWidth;
            $destHeight = floor($srcHeight * $ratio);
        } elseif (is_null($destWidth) && !is_null($destHeight)) {
            $ratio = $destHeight / $srcHeight;
            $destWidth = floor($srcWidth * $ratio);
        } elseif (is_null($destWidth) && is_null($destHeight)) {
            $destWidth  = $srcWidth;
            $destHeight = $srcHeight;
        }

        $image = imagecreatetruecolor($destWidth, $destHeight);

        imagecopyresampled(
            $image,
            $canvas->getResource(),
            0,
            0,
            0,
            0,
            $destWidth,
            $destHeight,
            $srcWidth,
            $srcHeight
        );

        return $canvas->withResource($image);
    }
}
