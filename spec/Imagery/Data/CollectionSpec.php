<?php

namespace spec\Imagery\Data;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CollectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith([]);
        $this->shouldHaveType('Imagery\Data\Collection');
        $this->shouldImplement('Imagery\ArrayConvertible');
    }

    function it_should_be_countable()
    {
        $this->beConstructedWith([]);
        $this->shouldImplement('Countable');
        $this->count()->shouldBeEqualTo(0);
    }

    function it_should_be_traversable()
    {
        $this->beConstructedWith([]);
        $this->shouldImplement('Traversable');
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

    function it_should_return_the_data_value_when_it_does_exist()
    {
        $this->beConstructedWith([
            'other1' => 'value1',
            'other2' => 'value2',
            'other3' => 'value3'
        ]);
        $this->getDataValue('other2')->shouldBeEqualTo('value2');
    }

    function it_should_return_null_when_it_does_not_exist()
    {
        $this->beConstructedWith([]);
        $this->getDataValue('target')->shouldBeNull();
    }

    function it_should_find_an_existing_data()
    {
        $this->beConstructedWith([
            'target' => 'value'
        ]);
        $this->find('target')->shouldHaveType('Imagery\Data\Data');
    }

    function it_should_return_null_when_it_does_not_find_a_data()
    {
        $this->beConstructedWith();
        $this->find('target')->shouldBeNull();
    }

    function it_should_return_an_array_representation()
    {
        $this->beConstructedWith([
            'other1' => 'value1',
            'other2' => 'value2',
            'other3' => 'value3'
        ]);
        $this->toArray()->shouldBeEqualTo([
            'other1' => 'value1',
            'other2' => 'value2',
            'other3' => 'value3'
        ]);
    }
}
