<?php

namespace spec\Imagery\Parameters;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InterlaceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Imagery\Parameters\Interlace');
        $this->shouldHaveType('Imagery\Parameters\AbstractFactory');
    }

    function it_should_return_its_name()
    {
        $this->getName()->shouldBeEqualTo('interlace');
    }

    function it_should_return_the_parameters()
    {
        $this->getParameters([])->shouldHaveType('Imagery\Parameters\Parameters');
    }

    function it_should_not_map_any_parameters()
    {
        $this->getParameters([])->count()->shouldBeEqualTo(0);
    }
}
