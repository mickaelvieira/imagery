<?php

namespace spec\Imagery\Extractor;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ExifSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Imagery\Extractor\Exif');
        $this->shouldImplement('Imagery\Extractor');
    }
}
