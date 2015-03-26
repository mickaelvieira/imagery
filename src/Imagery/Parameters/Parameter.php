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
 * Class Parameter
 * @package Imagery\Parameters
 */
final class Parameter
{

    const TYPE_INTEGER = 'int';
    const TYPE_BOOLEAN = 'bool';
    const TYPE_STRING  = 'string';
    const TYPE_FLOAT   = 'float';

    /**
     * @var array
     */
    private $types = [
        'int',
        'integer',
        'string',
        'float',
        'bool',
    ];

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @var bool
     */
    private $maybeNull = false;

    /**
     * @param string $name
     * @param string $type
     */
    public function __construct($name, $type)
    {
        if (!in_array($type, $this->types)) {
            throw new \LogicException(sprintf("%s is not a valid type", $type));
        }

        $this->name = (string)$name;
        $this->type = (string)$type;
    }

    /**
     * @return \Imagery\Parameters\Parameter
     */
    public function maybeNull()
    {
        $copy = clone $this;
        $copy->maybeNull = true;

        return $copy;
    }

    /**
     * @param mixed $value
     * @return \Imagery\Parameters\Parameter
     * @throw \BadMethodCallException
     */
    public function withValue($value)
    {
        if (is_null($value)) {
            if (!$this->maybeNull) {
                throw new \BadMethodCallException(sprintf("Argument %s cannot be null", $this->name));
            }
        } elseif (!$this->hasCorrectType($value)) {
            throw new \BadMethodCallException(
                sprintf(
                    "Argument %s must have type %s, but got %s",
                    $this->name,
                    $this->type,
                    gettype($value)
                )
            );
        }

        $copy = clone $this;
        $copy->value = $value;

        return $copy;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return bool
     * @throw \LogicException
     */
    private function hasCorrectType($value)
    {
        $method = "is_" . $this->type;
        return $method($value);
    }
}
