<?php

namespace spec\Imagery;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ImageSpec extends ObjectBehavior
{
    /**
     * @var vfsStreamDirectory
     */
    private $workDir;

    function let()
    {
        $this->workDir = vfsStream::setup('dir');

        $jpeg = vfsStream::newFile('file.jpg');
        $gif  = vfsStream::newFile('file.gif');
        $png  = vfsStream::newFile('file.png');

        $jpeg->setContent($this->getJpeg());
        $gif->setContent($this->getGif());
        $png->setContent($this->getPng());

        $this->workDir->addChild($jpeg);
        $this->workDir->addChild($gif);
        $this->workDir->addChild($png);
    }

    function it_is_initializable()
    {
        $this->beConstructedWith(vfsStream::url('dir/file.jpg'));
        $this->shouldHaveType('Imagery\Image');
        $this->getPathname()->shouldReturn('vfs://dir/file.jpg');
    }

    function it_should_throw_an_exception_when_the_file_is_not_image()
    {
        $this->shouldThrow('\LogicException')->during('__construct', [vfsStream::url('dir/test.csv')]);
    }

    function it_should_return_the_image_dimensions()
    {
        $this->beConstructedWith(vfsStream::url('dir/file.jpg'));

        $this->getWidth()->shouldReturn(500);
        $this->getHeight()->shouldReturn(400);
    }

    function it_should_return_the_jpeg_mime_type()
    {
        $this->beConstructedWith(vfsStream::url('dir/file.jpg'));
        $this->getMimeType()->shouldBeEqualTo("image/jpeg");
    }

    function it_should_return_the_gif_mime_type()
    {
        $this->beConstructedWith(vfsStream::url('dir/file.gif'));
        $this->getMimeType()->shouldBeEqualTo("image/gif");
    }

    function it_should_return_the_png_mime_type()
    {
        $this->beConstructedWith(vfsStream::url('dir/file.png'));
        $this->getMimeType()->shouldBeEqualTo("image/png");
    }

    function it_should_know_when_the_image_is_a_jpeg()
    {
        $this->beConstructedWith(vfsStream::url('dir/file.jpg'));
        $this->shouldBeJpeg();
    }

    function it_should_know_when_the_image_is_a_gif()
    {
        $this->beConstructedWith(vfsStream::url('dir/file.gif'));
        $this->shouldBeGif();
    }

    function it_should_know_when_the_image_is_a_png()
    {
        $this->beConstructedWith(vfsStream::url('dir/file.png'));
        $this->shouldBePng();
    }

    function it_should_know_the_image_orientation()
    {
        $this->beConstructedWith(vfsStream::url('dir/file.jpg'));
        $this->shouldBeLandscape();
        $this->shouldNotBePortrait();
    }

    function it_should_return_the_jpeg_exif_collection()
    {
        $this->beConstructedWith(vfsStream::url('dir/file.jpg'));
        $this->getExif()->shouldHaveType('\Imagery\Data\Collection');
    }

    function it_should_return_the_jpeg_iptc_collection()
    {
        $this->beConstructedWith(vfsStream::url('dir/file.jpg'));
        $this->getIptc()->shouldHaveType('\Imagery\Data\Collection');
    }

    function it_should_not_return_the_gif_exif_collection()
    {
        $this->beConstructedWith(vfsStream::url('dir/file.gif'));
        $this->getExif()->shouldBeNull();
    }

    function it_should_not_return_the_gif_iptc_collection()
    {
        $this->beConstructedWith(vfsStream::url('dir/file.gif'));
        $this->getIptc()->shouldBeNull();
    }

    function it_should_not_return_the_png_exif_collection()
    {
        $this->beConstructedWith(vfsStream::url('dir/file.png'));
        $this->getExif()->shouldBeNull();
    }

    function it_should_not_return_the_png_iptc_collection()
    {
        $this->beConstructedWith(vfsStream::url('dir/file.png'));
        $this->getIptc()->shouldBeNull();
    }

    function it_should_rotate_the_resource()
    {
        $this->beConstructedWith(vfsStream::url('dir/file.png'));
        $this->shouldNotThrow('\Exception')->duringRotate();
    }

    function it_should_flip_the_resource()
    {
        $this->beConstructedWith(vfsStream::url('dir/file.png'));
        $this->shouldNotThrow('\Exception')->duringFlip();
    }

    function it_should_interlace_the_resource()
    {
        $this->beConstructedWith(vfsStream::url('dir/file.png'));
        $this->shouldNotThrow('\Exception')->duringInterlace();
    }

    function it_should_crop_the_resource()
    {
        $this->beConstructedWith(vfsStream::url('dir/file.png'));
        $this->shouldNotThrow('\Exception')->duringCrop();
    }

    function it_should_resize_the_resource()
    {
        $this->beConstructedWith(vfsStream::url('dir/file.png'));
        $this->shouldNotThrow('\Exception')->duringResize();
    }

    function it_should_throw_when_there_is_no_command_available()
    {
        $this->beConstructedWith(vfsStream::url('dir/file.png'));
        $this->shouldThrow('\Exception')->duringTest();
    }

    function letGo()
    {
        $this->workDir = null;
    }

    function getJpeg()
    {
        $gd = imagecreate(500, 400);
        ob_start();
        imagejpeg($gd);
        $content = ob_get_clean();

        return $content;
    }

    function getPng()
    {
        $gd = imagecreatetruecolor(500, 400);
        ob_start();
        imagepng($gd);
        $content = ob_get_clean();

        return $content;
    }

    function getGif()
    {
        $gd = imagecreate(500, 400);
        ob_start();
        imagegif($gd);
        $content = ob_get_clean();

        return $content;
    }

}
