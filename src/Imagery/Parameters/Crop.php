<?php

/*
 * This file is part of Imagery package
 *
 * (c) Mickaël Vieira <contact@mickael-vieira.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Imagery\Parameters;

/**
 * Class Crop
 * @package Imagery\Parameters
 */
class Crop extends AbstractFactory
{
    /**
     * {@inheritdoc}
     */
    protected function getMap()
    {
        return [
            0 => new Parameter('width', Parameter::TYPE_INTEGER),
            1 => new Parameter('height', Parameter::TYPE_INTEGER)
        ];
    }
}
