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
 * Class Transformer
 * @package Imagery
 */
final class Transformer
{

    /**
     * @var \Imagery\Image $image
     */
    private $image;

    /**
     * @var resource
     */
    private $resource;

    /**
     * @var int
     */
    private $destWidth;

    /**
     * @var int
     */
    private $destHeight;

    /**
     * @param \Imagery\Image $image
     */
    public function __construct(Image $image)
    {
        $this->image      = $image;
        $this->resource   = $this->image->getResource();
        $this->destWidth  = $this->image->getWidth();
        $this->destHeight = $this->image->getHeight();
    }

    /**
     * @param string $path
     * @param int $compression from 0 to 100
     * @return bool
     */
    public function save($path, $compression = 100)
    {
        $compression = $this->prepareCompression($compression);

        $image = $this->getCanvas();

        imagecopyresampled(
            $image,
            $this->resource,
            0,
            0,
            0,
            0,
            $this->destWidth,
            $this->destHeight,
            $this->image->getWidth(),
            $this->image->getHeight()
        );

        if ($this->image->isJpeg()) {
            imageinterlace($this->resource, true);
            $result = imagejpeg($this->resource, $path, $compression);
        } elseif ($this->image->isGif()) {
            $result = imagegif($this->resource, $path);
        } elseif ($this->image->isPng()) {
            $result = imagepng($this->resource, $path, $compression);
        } else {
            throw new \LogicException("Cannot generate resource, file type must be JPEG, GIF, PNG");
        }
        imagedestroy($this->resource);

        return $result;
    }

    /**
     * @return resource
     */
    private function getCanvas()
    {
        $image = imagecreatetruecolor($this->destWidth, $this->destWidth);

        if ($this->image->isJpeg()) {
            $background = imagecolorallocate($image, 255, 255, 255);
            imagefilledrectangle($image, 0, 0, $this->destWidth, $this->destHeight, $background);
        } elseif ($this->image->isGif()) {
            $background = imagecolorallocatealpha($image, 255, 255, 255, 1);
            imagecolortransparent($image, $background);
            imagefill($image, 0, 0 , $background);
            imagesavealpha($image, true);
        } elseif ($this->image->isPng()) {
            imagealphablending($image, false);
            imagesavealpha($image, true);
        } else {
            throw new \LogicException("Cannot generate resource, file type must be JPEG, GIF, PNG");
        }

        return $image;
    }

    /**
     * @param int $height
     * @return \Imagery\Transformer
     */
    public function resizeToHeight($height)
    {
        $ratio = $height / $this->image->getHeight();
        $width = $this->image->getWidth() * $ratio;

        return $this->resize($width, $height);
    }

    /**
     * @param int $width
     * @return \Imagery\Transformer
     */
    public function resizeToWidth($width)
    {
        $ratio  = $width / $this->image->getWidth();
        $height = $this->image->getHeight() * $ratio;

        return $this->resize($width, $height);
    }

    /**
     * @param $scale
     * @return \Imagery\Transformer
     */
    public function scale($scale)
    {
        $width = $this->image->getWidth() * $scale / 100;
        $height = $this->image->getHeight() * $scale / 100;

        return $this->resize($width, $height);
    }

    /**
     * @param int $width
     * @param int  $height
     * @return \Imagery\Transformer
     */
    private function resize($width, $height)
    {
        $this->destWidth  = $width;
        $this->destHeight = $height;

        return $this;
    }

    /**
     * @param $degrees
     */
    public function rotate($degrees)
    {
        $this->resource = imagerotate($this->resource, $degrees, 0);
    }

    /**
     * @param int $mode
     * @return \Imagery\Transformer
     * @throws \Exception
     */
    public function flip($mode)
    {
        $result = imageflip($this->resource , $mode);
        if (!$result) {
            throw new \Exception("Cannot flip image");
        }
        return $this;
    }

    /**
     * @param $compression
     * @return float|int
     */
    private function prepareCompression($compression)
    {
        if ($this->image->isPng()) {

            $compression = ceil($compression / 10);
            if ($compression < 1) {
                $compression = 1;
            }
            $compression = (10 - $compression);

        } elseif ($compression > 100) {
            $compression = 100;
        } elseif ($compression < 0) {
            $compression = 0;
        }

        return $compression;
    }
}
