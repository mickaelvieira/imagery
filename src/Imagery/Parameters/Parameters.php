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
 * Class Collection
 * @package Imagery
 */
final class Parameters implements \Countable
{
    /**
     * @var \Imagery\Parameters\Parameter[] $parameters
     */
    private $parameters = [];

    /**
     * @param \Imagery\Parameters\Parameter[] $parameters
     */
    public function __construct(array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->parameters);
    }

    /**
     * @param $name
     * @return mixed
     * @throw \LogicException
     */
    public function getByName($name)
    {
        $parameters = array_filter($this->parameters, function (Parameter $parameter) use ($name) {
            return $parameter->getName() === $name;
        });

        if (empty($parameters)) {
            throw new \LogicException(sprintf("Parameter with name %s does not exist", $name));
        }
        $parameter = current($parameters);

        return $parameter->getValue();
    }
}
