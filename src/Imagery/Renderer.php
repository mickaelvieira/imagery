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

/**
 * Interface Renderer
 * @package Imagery
 */
interface Renderer
{
    /**
     * @param string $path
     * @param resource $source
     * @param int $quality
     * @return bool
     */
    public function render($path, $source, $quality);
}
