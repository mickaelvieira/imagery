<?php


namespace Imagery;

/**
 * Class DataCollection
 * @package Imagery
 */
final class DataCollection implements \Countable, \IteratorAggregate
{

    /**
     * @var \Imagery\Data[]
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
     * @return \Imagery\Data
     */
    public function find($name)
    {
        $data = array_filter($this->data, function(Data $data) use ($name) {
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
     * @param string $name
     * @param string $value
     * @return \Imagery\DataCollection
     */
    public function withParam($name, $value)
    {
        $copy = clone $this;
        //$copy->add($name, $value);
        return $copy;
    }
}
