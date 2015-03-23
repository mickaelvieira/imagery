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

use Imagery\Extractor;

/**
 * Class Exif
 * @package Imagery\Extractor
 */
final class Exif implements Extractor
{
    /**
     * @param array $data
     * @return array
     */
    public function extract(array $data)
    {
        $extracted = [];

        $iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($data));

        foreach ($iterator as $k => $v) {
            if (!is_numeric($k)) {
                $k = preg_replace('/\./', '_', $k);
                $extracted[$k] = $v;
            }
        }

        return $extracted;
    }
}
