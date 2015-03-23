<?php

namespace Imagery\Extractor;


use Imagery\Extractor;

final class Exif implements Extractor
{

    /**
     * @param string $path
     * @return array
     */
    public function extract($path)
    {
        $extracted = [];

        if (function_exists("exif_read_data")) {

            $sections = @exif_read_data($path, null, true, false);
            $iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($sections));

            foreach($iterator as $k => $v) {
                if (!is_numeric($k)) {
                    $k = preg_replace('/\./', '_', $k);
                    $extracted[$k] = $v;
                }
            }

        }
        return $extracted;
    }
}