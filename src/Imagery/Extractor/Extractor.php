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
