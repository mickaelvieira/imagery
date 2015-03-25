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
 * Interface Command
 * @package Imagery
 */
interface Command
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param \Imagery\Canvas $canvas
     * @param \Imagery\Parameters $options
     * @return resource
     */
    public function execute(Canvas $canvas, Parameters $options = null);
}
