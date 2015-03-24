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
 * Class Factory
 * @package Imagery\Extractor
 */
final class Factory
{
    /**
     * @param int $type
     * @return \Imagery\Extractor\Extractor
     */
    public static function select($type)
    {
        if ($type === "exif") {
            return new ExifExtractor();
        } elseif ($type === "iptc") {
            return new IptcExtractor();
        } else {
            throw new \BadMethodCallException(sprintf("Type %s is not supported, expected exif or iptc", $type));
        }
    }
}
