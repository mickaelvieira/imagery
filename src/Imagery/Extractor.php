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
 * Interface Extractor
 * @package Imagery
 */
interface Extractor
{
    /**
     * @param array $data
     * @return array
     */
    public function extract(array $data);
}
