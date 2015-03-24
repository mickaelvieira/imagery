<?php


namespace Imagery\Command;


use Imagery\Command;
use Imagery\Options;

final class Interlace implements Command
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
        imageinterlace($resource, (int)$options->get('interlace', 0));

        return $resource;
    }
}
