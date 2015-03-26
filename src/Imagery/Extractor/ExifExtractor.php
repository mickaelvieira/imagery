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

use Imagery\Data\Collection;

/**
 * Class Exif
 * @package Imagery\Extractor
 */
final class ExifExtractor implements Extractor
{
    /**
     * {@inheritdoc}
     */
    public function extract($path)
    {
        $data = [];
        $raw  = $this->getRawData($path);

        $iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($raw));

        foreach ($iterator as $k => $v) {
            if (!is_numeric($k)) {
                $k = preg_replace('/\./', '_', $k);
                $data[$k] = $v;
            }
        }

        return new Collection($data);
    }

    /**
     * @param string $path
     * @return array
     */
    private function getRawData($path)
    {
        $data = [];
        if (function_exists("exif_read_data")) {
            $data = @exif_read_data($path, null, true, false);
        }
        return $data;
    }
}
