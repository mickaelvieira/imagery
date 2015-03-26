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
 * Class AbstractFactory
 * @package Imagery\Parameters
 */
abstract class AbstractFactory
{
    /**
     * string
     */
    public function getName()
    {
        return strtolower(end(explode("\\", get_class($this))));
    }

    /**
     * {@inheritdoc}
     */
    public function getParameters(array $parameters)
    {
        return new Parameters($this->mapParameters($parameters));
    }

    /**
     * @return \Imagery\Parameters\Parameter[]
     */
    abstract protected function getMap();

    /**
     * @param array $parameters
     * @return array
     */
    private function mapParameters(array $parameters)
    {
        $params = [];
        foreach ($this->getMap() as $key => $parameter) {
            if (array_key_exists($key, $parameters)) {
                $parameter = $parameter->withValue($parameters[$key]);
            }
            array_push($params, $parameter);
        }

        return $params;
    }
}
