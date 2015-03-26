<?php

/*
 * This file is part of Imagery package
 *
 * (c) Mickaël Vieira <contact@mickael-vieira.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Imagery\Extractor;

/**
 * Interface Extractor
 * @package Imagery
 */
interface Extractor
{
    /**
     * @param string $path
     * @return \Imagery\Data\Collection
     */
    public function extract($path);
}
