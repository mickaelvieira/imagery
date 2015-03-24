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

namespace Imagery\Renderer;

/**
 * Class PngRenderer
 * @package Imagery\Renderer
 */
final class PngRenderer implements Renderer
{
    /**
     * @var resource
     */
    private $source;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * {@inheritdoc}
     */
    public function render($path, $source, $quality)
    {
        $this->source = $source;
        $this->width  = imagesx($source);
        $this->height = imagesy($source);

        return imagepng($this->getResource(), $path, $quality);
    }

    /**
     * @return resource
     */
    private function getResource()
    {
        $image = imagecreatetruecolor($this->width, $this->height);
        imagealphablending($image, false);
        imagesavealpha($image, true);

        imagecopy($image, $this->source, 0, 0, 0, 0, $this->width, $this->height, $this->width, $this->height);

        return $image;
    }
}
