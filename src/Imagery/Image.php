<?php

/*
 * This file is part of Imagery package
 *
 * (c) Mickaël Vieira <contact@mickael-vieira.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Imagery;

use Imagery\Extractor\Factory as ExtractorFactory;
use Imagery\Command\Manager as CommandManager;
use Imagery\Parameters\Manager as ParametersManager;

/**
 * Class Image
 * @package Imagery
 */
final class Image extends \SplFileInfo
{
    /**
     * @var \Imagery\Data\Collection
     */
    private $iptc;

    /**
     * @var \Imagery\Data\Collection
     */
    private $exif;

    /**
     * @var \Imagery\Command\Manager
     */
    private $commander;

    /**
     * @var \Imagery\Parameters\Manager
     */
    private $parameters;

    /**
     * @var \Imagery\Canvas
     */
    private $canvas;

    /**
     * @param string $file_name
     */
    public function __construct($file_name)
    {
        parent::__construct($file_name);

        $this->isImage();

        $this->canvas     = Canvas::fromPath($this->getPathname());
        $this->commander  = new CommandManager();
        $this->parameters = new ParametersManager();

        if ($this->isJpeg()) {
            $this->iptc = ExtractorFactory::select('iptc')->extract($this->getPathname());
            $this->exif = ExtractorFactory::select('exif')->extract($this->getPathname());
        }
    }

    /**
     * @param null|string $path
     * @param int  $quality
     * @return bool
     */
    public function save($path = null, $quality = 100)
    {
        $renderer = new Renderer\Renderer($this->canvas);

        return $renderer->render($path, $quality);
    }

    /**
     * @return \Imagery\Data\Collection
     */
    public function getExif()
    {
        return $this->exif;
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
        return $this->canvas->getMimeType();
    }

    /**
     * @return bool
     */
    public function isLandscape()
    {
        return $this->canvas->isLandscape();
    }

    /**
     * @return bool
     */
    public function isPortrait()
    {
        return $this->canvas->isPortrait();
    }

    /**
     * @return \Imagery\Data\Collection
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
        return $this->canvas->isJpeg();
    }

    /**
     * @return bool
     */
    public function isGif()
    {
        return $this->canvas->isGif();
    }

    /**
     * @return bool
     */
    public function isPng()
    {
        return $this->canvas->isPng();
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
            $this->canvas = $command->execute($this->canvas, $this->parameters->find($name, $arguments));
        } else {
            throw new \LogicException(sprintf("Unknown command %s", $command));
        }
        return $this;
    }

    /**
     * @throw \LogicException
     */
    private function isImage()
    {
        $info = @getimagesize($this->getPathname());
        if (!$info) {
            throw new \LogicException(sprintf("File %s is not an image", $this->getPathname()));
        }
    }
}
