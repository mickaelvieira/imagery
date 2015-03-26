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
 * Class Factory
 * @package Imagery\Extractor
 */
final class Factory
{
    /**
     * @param int $type
     * @return \Imagery\Extractor\Extractor
     * @throw \LogicException
     */
    public static function select($type)
    {
        if ($type === "exif") {
            return new ExifExtractor();
        } elseif ($type === "iptc") {
            return new IptcExtractor();
        } else {
            throw new \LogicException(sprintf("Type %s is not supported, expected exif or iptc", $type));
        }
    }
}
