<?php


namespace Imagery\Extractor;


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
