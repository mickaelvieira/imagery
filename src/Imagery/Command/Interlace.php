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
use Imagery\Parameters\Parameters;

/**
 * Class Interlace
 * @package Imagery\Command
 */
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
    public function execute(Canvas $canvas, Parameters $parameters = null)
    {
        $resource = $canvas->getResource();

        imageinterlace($resource, (int)$parameters->get('interlace', 0));

        return $canvas->withResource($resource);
    }
}
