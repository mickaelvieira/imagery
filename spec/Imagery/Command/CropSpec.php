<?php

namespace spec\Imagery\Command;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CropSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Imagery\Command\Crop');
    }
}
