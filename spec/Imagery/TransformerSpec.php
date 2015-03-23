<?php

namespace spec\Imagery;

use Imagery\Image;
use org\bovigo\vfs\vfsStream;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TransformerSpec extends ObjectBehavior
{
    /**
     * @var vfsStreamDirectory
     */
    private $workDir;


    function let()
    {
        $this->workDir = vfsStream::setup('dir');
        $jpeg = vfsStream::newFile('file.jpg');
        $jpeg->setContent($this->getJpeg());

        $this->workDir->addChild($jpeg);
    }

    function it_is_initializable()
    {
        $this->beConstructedWith(new Image(vfsStream::url("dir/file.jpg")));
        $this->shouldHaveType('Imagery\Transformer');
    }

    /**
     * https://github.com/mikey179/vfsStream/issues/57
     */
    function xit_should_save_the_image()
    {
        $this->beConstructedWith(new Image(vfsStream::url("dir/file.jpg")));
        $this->save(vfsStream::url("dir/file2.jpg"));
    }

    function getJpeg()
    {
        $gd = imagecreate(500, 400);
        ob_start();
        imagejpeg($gd);
        $content = ob_get_clean();

        return $content;
    }


}
