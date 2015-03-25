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

namespace Imagery\Command;

use Imagery\Canvas;
use Imagery\Command;
use Imagery\Options;

/**
 * Class Rotate
 * @package Imagery\Command
 */
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
    public function execute(Canvas $canvas, Options $options = null)
    {
        return $canvas->withResource(imagerotate($canvas->getResource(), $options->get('degrees'), 0));
    }
}
