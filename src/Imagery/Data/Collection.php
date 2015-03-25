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

namespace Imagery\Data;

use Imagery\ArrayConvertible;

/**
 * Class Collection
 * @package Imagery\Data
 */
final class Collection implements \Countable, \IteratorAggregate, ArrayConvertible
{

    /**
     * @var \Imagery\Data\Data[]
     */
    private $data = [];

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $name => $value) {
            array_push($this->data, new Data($name, $value));
        }
    }

    /**
     * @param $name
     * @return \Imagery\Data\Data
     */
    public function find($name)
    {
        $data = array_filter($this->data, function (Data $data) use ($name) {
            return ($data->getName() === $name);
        });
        return (current($data)) ?: null;
    }

    /**
     * @param string $name
     * @return null|string
     */
    public function getDataValue($name)
    {
        $data = $this->find($name);
        return ($data) ? $data->getValue() : null;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->data);
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->data);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [];
        foreach ($this->data as $d) {
            $data[$d->getName()] = $d->getValue();
        }
        return $data;
    }
}
