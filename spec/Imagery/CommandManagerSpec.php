<?php

namespace spec\Imagery;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CommandManagerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Imagery\CommandManager');
    }

    function it_should_find_the_crop_command()
    {
        $this->find('crop')->shouldHaveType('Imagery\Command\Crop');
    }

    function it_should_find_the_flip_command()
    {
        $this->find('flip')->shouldHaveType('Imagery\Command\Flip');
    }

    function it_should_find_the_interlace_command()
    {
        $this->find('interlace')->shouldHaveType('Imagery\Command\Interlace');
    }

    function it_should_find_the_resize_command()
    {
        $this->find('resize')->shouldHaveType('Imagery\Command\Resize');
    }

    function it_should_find_the_rotate_command()
    {
        $this->find('rotate')->shouldHaveType('Imagery\Command\Rotate');
    }

    function it_should_find_the_scale_command()
    {
        $this->find('scale')->shouldHaveType('Imagery\Command\Scale');
    }

    function it_should_throw_an_exception_when_a_command_does_not_exist()
    {
        $this->shouldThrow('\LogicException')->duringFind('test');
    }
}
