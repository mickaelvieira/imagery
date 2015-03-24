<?php


namespace Imagery\Command;


use Imagery\Command;
use Imagery\Options;

final class Rotate implements Command
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return strtolower(end(explode("\\", __CLASS__)));
    }

    /**
     * {@inheritdoc}
     */
    public function execute($resource, Options $options = null)
    {
        return imagerotate($resource, $options->get('degrees'), 0);
    }
}
