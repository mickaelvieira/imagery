<?php

namespace spec\Imagery\Parameters;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ManagerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Imagery\Parameters\Manager');
    }

    function it_should_build_crop_a_parameters()
    {
        $this->find('crop', [])->shouldHaveType('Imagery\Parameters\Parameters');
    }

    function it_should_build_flip_a_parameters()
    {
        $this->find('flip', [])->shouldHaveType('Imagery\Parameters\Parameters');
    }

    function it_should_build_interlace_a_parameters()
    {
        $this->find('interlace', [])->shouldHaveType('Imagery\Parameters\Parameters');
    }

    function it_should_build_resize_a_parameters()
    {
        $this->find('resize', [])->shouldHaveType('Imagery\Parameters\Parameters');
    }

    function it_should_build_rotate_a_parameters()
    {
        $this->find('rotate', [])->shouldHaveType('Imagery\Parameters\Parameters');
    }

    function it_should_build_scale_a_parameters()
    {
        $this->find('scale', [])->shouldHaveType('Imagery\Parameters\Parameters');
    }

    function it_should_throw_an_exception_when_a_command_does_not_exist()
    {
        $this->shouldThrow('\LogicException')->duringFind('test', []);
    }
}
