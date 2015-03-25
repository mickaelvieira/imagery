<?php

namespace spec\Imagery\Parameters;

use Imagery\Parameters\Parameter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ParametersSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Imagery\Parameters\Parameters');
    }

    function it_should_be_countable()
    {
        $this->beConstructedWith([]);
        $this->shouldImplement('Countable');
        $this->count()->shouldBeEqualTo(0);
    }

    function it_should_add_elements_when_it_is_initialized()
    {
        $this->beConstructedWith([
            'other1' => 'value',
            'other2' => 'value',
            'other3' => 'value'
        ]);

        $this->count()->shouldBeEqualTo(3);
    }

    function it_should_return_an_option()
    {
        $this->beConstructedWith([
            (new Parameter('other1', 'string'))->withValue('value1'),
            (new Parameter('other2', 'string'))->withValue('value2'),
            (new Parameter('other3', 'string'))->withValue('value3')
        ]);

        $this->get('other2')->shouldBeEqualTo('value2');
    }

    function it_should_throw_an_exception_when_a_parameter_does_not_exist()
    {
        $this->beConstructedWith([
            (new Parameter('other1', 'string'))->withValue('value1'),
            (new Parameter('other2', 'string'))->withValue('value2'),
            (new Parameter('other3', 'string'))->withValue('value3')
        ]);

        $this->shouldThrow('\LogicException')->duringGet('other4');
    }
}
