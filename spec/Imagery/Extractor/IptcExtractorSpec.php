<?php

namespace spec\Imagery\Extractor;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IptcExtractorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Imagery\Extractor\IptcExtractor');
        $this->shouldImplement('Imagery\Extractor\Extractor');
    }
}
