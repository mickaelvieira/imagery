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

/**
 * Class Factory
 * @package Imagery\Renderer
 */
final class Factory
{
    /**
     * @var array
     */
    private $renderers;

    /**
     *
     */
    public function __construct()
    {
        $this->renderers = [
            IMAGETYPE_JPEG => new JpegRenderer(),
            IMAGETYPE_GIF  => new GifRenderer(),
            IMAGETYPE_PNG  => new PngRenderer()
        ];
    }

    /**
     * @param int $type
     * @return \Imagery\Renderer
     * @throw \BadMethodCallException
     */
    public function select($type)
    {
        if (array_key_exists($type, $this->renderers)) {
            return $this->renderers[$type];
        } else {
            throw new \BadMethodCallException(sprintf("Type %s is not supported", $type));
        }
    }
}
