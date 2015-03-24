<?php

namespace spec\Imagery\Extractor;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ExifExtractorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Imagery\Extractor\ExifExtractor');
        $this->shouldImplement('Imagery\Extractor\Extractor');
    }
}
