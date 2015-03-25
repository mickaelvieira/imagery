<?php

namespace Imagery\Parameters;

class Crop extends AbstractFactory
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return strtolower(end(explode("\\", __CLASS__)));
    }

    /**
     * {@inheritdoc}
     */
    protected function getMap()
    {
        return [
            0 => 'width',
            1 => 'height'
        ];
    }
}
