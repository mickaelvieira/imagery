<?php


namespace Imagery;


interface Extractor
{
    /**
     * @param string $path
     * @return array
     */
    public function extract($path);
}
