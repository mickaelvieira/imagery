<?php

namespace spec\Imagery\Renderer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Imagery\Renderer\Factory');
    }

    function it_should_select_a_renderer_for_image_gif()
    {
        $this->select(IMAGETYPE_GIF)->shouldHaveType('Imagery\Renderer\GifRenderer');
    }

    function it_should_select_a_renderer_for_image_png()
    {
        $this->select(IMAGETYPE_PNG)->shouldHaveType('Imagery\Renderer\PngRenderer');
    }

    function it_should_select_a_renderer_for_image_jpeg()
    {
        $this->select(IMAGETYPE_JPEG)->shouldHaveType('Imagery\Renderer\JpegRenderer');
    }

    function it_should_throw_an_exception_when_a_renderer_does_not_exist()
    {
        $this->shouldThrow('\LogicException')->duringSelect(IMAGETYPE_BMP);
    }
}
