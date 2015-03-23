<?php


namespace Imagery;


interface Extractor
{
    /**
     * @param array $data
     * @return array
     */
    public function extract(array $data);
}
