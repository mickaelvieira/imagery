<?php

namespace spec\Imagery\Parameters;

use Imagery\Parameters\Parameter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ParameterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith("test", "test");
        $this->shouldHaveType('Imagery\Parameters\Parameter');
    }

    function it_should_throw_an_exception_when_type_is_invalid()
    {
        $this->shouldThrow('\LogicException')->during('__construct', ['test', 'test']);
    }

    function it_should_return_a_parameter_with_a_new_value_string()
    {
        $this->beConstructedWith('id', Parameter::TYPE_STRING);
        $this->withValue('test')->shouldNotBeEqualTo($this);
        $this->withValue('test')->getValue()->shouldBeEqualTo('test');
    }

    function it_should_return_a_parameter_with_a_new_value_integer()
    {
        $this->beConstructedWith('id', Parameter::TYPE_INTEGER);
        $this->withValue(1)->shouldNotBeEqualTo($this);
        $this->withValue(1)->getValue()->shouldBeEqualTo(1);
    }

    function it_should_throw_an_exception_when_the_type_is_not_valid()
    {
        $this->beConstructedWith('id', Parameter::TYPE_STRING);
        $this->shouldThrow()->duringWithValue(1);
    }

    function it_should_throw_an_exception_when_the_value_is_null()
    {
        $this->beConstructedWith('id', Parameter::TYPE_STRING);
        $this->shouldThrow()->duringWithValue(null);
    }

    function it_should_not_throw_an_exception_when_it_has_been_marked_as_may_be_null()
    {
        $this->beConstructedWith('id', Parameter::TYPE_STRING);
        $copy = $this->maybeNull();
        $copy->shouldNotThrow()->duringWithValue(null);
    }
}
