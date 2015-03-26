<?php

/*
 * This file is part of Imagery package
 *
 * (c) Mickaël Vieira <contact@mickael-vieira.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Imagery\Renderer;

use Imagery\Renderer as RendererInterface;

/**
 * Class GifRenderer
 * @package Imagery\Renderer
 */
final class GifRenderer implements RendererInterface
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

        return imagegif($this->getResource(), $path, $quality);
    }

    /**
     * @return resource
     */
    private function getResource()
    {
        $image = imagecreatetruecolor($this->width, $this->height);

        $background = imagecolorallocatealpha($image, 255, 255, 255, 1);
        imagecolortransparent($image, $background);
        imagefill($image, 0, 0, $background);
        imagesavealpha($image, true);

        imagecopy($image, $this->source, 0, 0, 0, 0, $this->width, $this->height);

        return $image;
    }
}
