<?php

namespace spec\Imagery;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ParamSpec extends ObjectBehavior
{
    function it_is_initializable()
    {

        $this->beConstructedWith(null, null);
        $this->shouldHaveType('Imagery\Data');
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

    function it_should_return_a_string_representation()
    {
        $this->beConstructedWith("my name", "my value");
        $this->__toString()->shouldBeEqualTo('my+name=my+value');
    }
}
