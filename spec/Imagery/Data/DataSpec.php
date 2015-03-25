<?php

namespace spec\Imagery\Data;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DataSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(null, null);
        $this->shouldHaveType('Imagery\Data\Data');
    }

    function it_should_return_its_name()
    {
        $this->beConstructedWith("my name", "my value");
        $this->getName()->shouldBeEqualTo("my name");
    }

    function it_should_return_its_value()
    {
        $this->beConstructedWith("my name", "my value");
        $this->getValue()->shouldBeEqualTo("my value");
    }
}
