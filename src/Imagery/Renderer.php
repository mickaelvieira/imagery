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

namespace Imagery;

use Imagery\Renderer\Factory as RendererFactory;

/**
 * Class Renderer
 * @package Imagery
 */
final class Renderer
{
    /**
     * @var \Imagery\Canvas;
     */
    private $canvas;

    /**
     * @param \Imagery\Canvas $canvas
     */
    public function __construct(Canvas $canvas)
    {
        $this->canvas = $canvas;
    }

    /**
     * @param string $path
     * @param int    $quality
     * @return bool
     */
    public function render($path, $quality)
    {
        $quality  = $this->prepareQuality($quality);
        $renderer = RendererFactory::select($this->canvas->getType());

        return $renderer->render($path, $this->canvas->getResource(), $quality);
    }

    /**
     * @param $quality
     * @return float|int
     */
    private function prepareQuality($quality)
    {
        if ($this->canvas->getType() === IMAGETYPE_PNG) {

            $quality = ceil($quality / 10);
            if ($quality < 1) {
                $quality = 1;
            }
            $quality = (10 - $quality);

        } elseif ($quality > 100) {
            $quality = 100;
        } elseif ($quality < 0) {
            $quality = 0;
        }

        return $quality;
    }
}
