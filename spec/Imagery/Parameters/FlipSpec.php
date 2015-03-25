<?php

namespace spec\Imagery\Parameters;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FlipSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Imagery\Parameters\Flip');
        $this->shouldHaveType('Imagery\Parameters\AbstractFactory');
    }

    function it_should_return_its_name()
    {
        $this->getName()->shouldBeEqualTo('flip');
    }

    function it_should_return_the_parameters()
    {
        $this->getParameters([])->shouldHaveType('Imagery\Parameters');
    }

    function it_should_map_the_parameters()
    {
        $this->getParameters([0 => 90])->get('mode')->shouldBeEqualTo(90);
    }
}
