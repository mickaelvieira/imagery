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
    public function execute(Canvas $canvas, Parameters $parameters = null)
    {
        $scale = $parameters->getByName('scale');

        if (is_null($scale)) {
            return $canvas;
        }

        $srcWidth  = $canvas->getWidth();
        $srcHeight = $canvas->getHeight();

        $width  = $srcWidth * $scale / 100;
        $height = $srcHeight * $scale / 100;

        $image = imagecreatetruecolor($width, $height);

        imagecopyresampled(
            $image,
            $canvas->getResource(),
            0,
            0,
            0,
            0,
            $width,
            $height,
            $srcWidth,
            $srcHeight
        );

        return $canvas->withResource($image);
    }
}
