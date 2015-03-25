<?php

namespace Imagery\Parameters;

use Imagery\Parameters;

class Scale extends AbstractFactory
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
            0 => 'scale'
        ];
    }
}
