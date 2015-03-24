<?php

/*
 * This file is part of CollectionJson, a php implementation
 * of the Collection+JSON Media Type
 *
 * (c) Mickaël Vieira <contact@mickael-vieira.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Imagery;

/**
 * Class Image
 * @package Imagery
 */
final class Image extends \SplFileInfo
{
    /**
     * @var \Imagery\DataCollection
     */
    private $iptc;

    /**
     * @var \Imagery\DataCollection
     */
    private $exif;

    /**
     * @var \Imagery\CommandManager
     */
    private $commander;

    /**
     * @var Canvas
     */
    private $canvas;

    /**
     * @param string $file_name
     * @param \Imagery\CommandManager $commander
     */
    public function __construct($file_name, CommandManager $commander = null)
    {
        parent::__construct($file_name);

        $info = @getimagesize($this->getPathname(), $iptc);

        if (!$info) {
            throw new \LogicException(sprintf("File %s is not an image", $this->getPathname()));
        }

        $this->commander = ($commander) ?: new CommandManager();
        $this->canvas    = Canvas::fromPath($this->getPathname());

        if ($this->isJpeg()) {
            if (is_array($iptc)) {
                $this->iptc = new DataCollection((new Extractor\Iptc())->extract($iptc));
            }
            if (function_exists("exif_read_data")) {
                $sections = @exif_read_data($this->getPathname(), null, true, false);
                $this->exif = new DataCollection((new Extractor\Exif())->extract($sections));
            }
        }
    }

    /**
     * @param null|string $path
     * @param int  $quality
     * @return bool
     */
    public function save($path = null, $quality = 100)
    {
        $renderer = new Renderer($this->canvas);

        return $renderer->render($path, $quality);
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->canvas->getWidth();
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->canvas->getHeight();
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        return $this->canvas->getMime();
    }

    /**
     * @return int
     */
    public function getImageType()
    {
        return $this->canvas->getType();
    }

    /**
     * @return DataCollection
     */
    public function getExif()
    {
        return $this->exif;
    }

    /**
     * @return bool
     */
    public function isLandscape()
    {
        return ($this->canvas->getWidth() > $this->canvas->getHeight());
    }

    /**
     * @return bool
     */
    public function isPortrait()
    {
        return ($this->canvas->getWidth() < $this->canvas->getHeight());
    }

    /**
     * @return \Imagery\DataCollection
     */
    public function getIptc()
    {
        return $this->iptc;
    }

    /**
     * @return bool
     */
    public function isJpeg()
    {
        return ($this->canvas->getType() === IMAGETYPE_JPEG);
    }

    /**
     * @return bool
     */
    public function isGif()
    {
        return ($this->canvas->getType() === IMAGETYPE_GIF);
    }

    /**
     * @return bool
     */
    public function isPng()
    {
        return ($this->canvas->getType() === IMAGETYPE_PNG);
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return \Imagery\Image
     */
    public function __call($name, $arguments)
    {
        $command = $this->commander->find($name);

        if ($command) {
            $this->canvas = $this->canvas->withResource(
                $command->execute(
                    $this->canvas->getResource(),
                    new Options($arguments)
                )
            );
        } else {
            throw new \LogicException(sprintf("Unknow command %s", $command));
        }
        return $this;
    }
}
