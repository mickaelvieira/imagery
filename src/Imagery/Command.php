<?php


namespace Imagery;


interface Command
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param resource $resource
     * @param \Imagery\Options $options
     * @return resource
     */
    public function execute($resource, Options $options = null);
}
