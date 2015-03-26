<?php

/*
 * This file is part of Imagery package
 *
 * (c) Mickaël Vieira <contact@mickael-vieira.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Imagery;

use Imagery\Parameters\Parameters;

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
     * @param \Imagery\Parameters\Parameters $parameters
     * @return \Imagery\Canvas
     */
    public function execute(Canvas $canvas, Parameters $parameters = null);
}
