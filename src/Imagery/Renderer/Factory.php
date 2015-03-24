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
 * Class Factory
 * @package Imagery\Renderer
 */
final class Factory
{

    /**
     * @var array
     */
    private static $renderers;

    /**
     *
     */
    public function __construct()
    {
        self::$renderers = [
            IMAGETYPE_JPEG => new JpegRenderer(),
            IMAGETYPE_GIF  => new GifRenderer(),
            IMAGETYPE_PNG  => new PngRenderer()
        ];
    }

    /**
     * @param int $type
     * @return \Imagery\Renderer\Renderer|null
     */
    public static function select($type)
    {
        return array_key_exists($type, self::$renderers) ? self::$renderers[$type] : null;
    }
}
