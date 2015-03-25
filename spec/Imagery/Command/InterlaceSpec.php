<?php

namespace spec\Imagery\Command;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InterlaceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Imagery\Command\Interlace');
    }
}
