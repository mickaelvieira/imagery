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

    function getJpeg()
    {
        $gd = imagecreate(500, 400);
        ob_start();
        imagejpeg($gd);
        $content = ob_get_clean();

        return $content;
    }


}
