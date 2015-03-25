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
 * Class AbstractFactory
 * @package Imagery\Parameters
 */
abstract class AbstractFactory
{
    /**
     * @return string
     */
    abstract public function getName();

    /**
     * {@inheritdoc}
     */
    public function getParameters(array $parameters)
    {
        return new Parameters($this->mapParameters($parameters));
    }

    /**
     * @return array
     */
    abstract protected function getMap();

    /**
     * @param array $parameters
     * @return array
     */
    protected function mapParameters(array $parameters)
    {
        $return = [];
        foreach ($this->getMap() as $key => $value) {
            if (array_key_exists($key, $parameters)) {
                $return[$value] = $parameters[$key];
            }
        }

        return $return;
    }
}
