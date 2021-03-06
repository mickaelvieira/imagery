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
    public function execute(Canvas $canvas, Parameters $parameters = null)
    {
        $srcWidth  = $canvas->getWidth();
        $srcHeight = $canvas->getHeight();

        $width  = $parameters->getByName('width');
        $height = $parameters->getByName('height');

        $srcX = ($srcWidth / 2) - ($width / 2);
        $srcY = ($srcHeight / 2) - ($height / 2);

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
            $width,
            $height
        );

        return $canvas->withResource($image);
    }
}
