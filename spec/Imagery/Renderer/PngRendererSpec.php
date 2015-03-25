<?php

namespace spec\Imagery\Renderer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PngRendererSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Imagery\Renderer\PngRenderer');
    }
}
