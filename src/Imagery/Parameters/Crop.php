<?php

/*
 * This file is part of CollectionJson, a php implementation
 * of the Collection+JSON Media Type
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
            0 => new Parameter('width', 'int'),
            1 => new Parameter('height', 'int')
        ];
    }
}
