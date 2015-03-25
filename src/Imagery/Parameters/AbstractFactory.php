<?php


namespace Imagery\Parameters;


use Imagery\Parameters;

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
