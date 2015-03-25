<?php

namespace Imagery\Parameters;

class Rotate extends AbstractFactory
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
            0 => 'degrees'
        ];
    }
}
