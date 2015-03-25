<?php

namespace spec\Imagery\Parameters;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CropSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Imagery\Parameters\Crop');
        $this->shouldHaveType('Imagery\Parameters\AbstractFactory');
    }

    function it_should_return_its_name()
    {
        $this->getName()->shouldBeEqualTo('crop');
    }

    function it_should_return_the_parameters()
    {
        $this->getParameters([])->shouldHaveType('Imagery\Parameters\Parameters');
    }

    function it_should_map_the_parameters()
    {
        $this->getParameters([0 => 300, 1 => 200])->get('width')->shouldBeEqualTo(300);
        $this->getParameters([0 => 300, 1 => 200])->get('height')->shouldBeEqualTo(200);
    }
}
