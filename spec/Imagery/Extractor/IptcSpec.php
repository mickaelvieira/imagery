<?php

namespace spec\Imagery\Extractor;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IptcSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Imagery\Extractor\Iptc');
        $this->shouldImplement('Imagery\Extractor');
    }
}
