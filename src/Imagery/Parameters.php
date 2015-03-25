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

namespace Imagery;

/**
 * Class Collection
 * @package Imagery
 */
final class Parameters implements \Countable
{
    /**
     * @var array
     */
    private $options = [];

    /**
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        foreach ($options as $name => $value) {
            $this->options[$name] = $value;
        }
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->options);
    }

    /**
     * @param string $name
     * @param null   $default
     * @return null
     */
    public function get($name, $default = null)
    {
        return (array_key_exists($name, $this->options)) ? $this->options[$name] : $default;
    }
}
