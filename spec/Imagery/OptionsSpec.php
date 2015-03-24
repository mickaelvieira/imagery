<?php

namespace spec\Imagery;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OptionsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Imagery\Options');
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
            'other1' => 'value1',
            'other2' => 'value2',
            'other3' => 'value3'
        ]);

        $this->get('other2')->shouldBeEqualTo('value2');
    }

    function it_should_return_the_default_value_when_option_does_not_exist_and_default_value_has_been_provided()
    {
        $this->beConstructedWith([
            'other1' => 'value1',
            'other2' => 'value2',
            'other3' => 'value3'
        ]);

        $this->get('other4', 'default value')->shouldBeEqualTo('default value');
    }

    function it_should_return_null_when_option_does_not_exist_and_default_value_has_not_been_provided()
    {
        $this->beConstructedWith([
            'other1' => 'value1',
            'other2' => 'value2',
            'other3' => 'value3'
        ]);

        $this->get('other4', 'default value')->shouldBeEqualTo('default value');
    }
}
