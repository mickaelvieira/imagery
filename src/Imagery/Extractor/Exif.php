<?php

namespace Imagery\Extractor;


use Imagery\Extractor;

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

        foreach($iterator as $k => $v) {
            if (!is_numeric($k)) {
                $k = preg_replace('/\./', '_', $k);
                $extracted[$k] = $v;
            }
        }

        return $extracted;
    }
}