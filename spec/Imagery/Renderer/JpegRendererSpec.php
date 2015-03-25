<?php

namespace spec\Imagery\Renderer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JpegRendererSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Imagery\Renderer\JpegRenderer');
    }
}
