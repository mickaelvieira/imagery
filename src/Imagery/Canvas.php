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

/**
 * Class Canvas
 * @package Imagery
 */
final class Canvas
{

    /**
     * @var int
     */
    private $type;

    /**
     * @var resource
     */
    private $resource;

    /**
     * @param int $type
     * @param resource $resource
     */
    public function __construct($type, $resource)
    {
        $this->type = $type;
        $this->isResource($resource);
        $this->resource = $resource;
    }

    /**
     * @param string $path
     * @return resource
     */
    public static function fromPath($path)
    {
        $type = exif_imagetype($path);

        if ($type === IMAGETYPE_JPEG) {
            $resource = imagecreatefromjpeg($path);
        } elseif ($type === IMAGETYPE_GIF) {
            $resource = imagecreatefromgif($path);
        } elseif ($type === IMAGETYPE_PNG) {
            $resource = imagecreatefrompng($path);
        } else {
            throw new \LogicException("Cannot generate resource, file type must be JPEG, GIF, PNG");
        }

        return new self($type, $resource);
    }

    /**
     * @param resource $resource
     * @return \Imagery\Canvas
     */
    public function withResource($resource)
    {
        $this->isResource($resource);

        $copy = $this;
        $copy->resource = $resource;
        return $copy;
    }

    /**
     * @return resource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        return image_type_to_mime_type($this->type);
    }

    /**
     * @return int
     */
    public function getImageType()
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return imagesx($this->resource);
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return imagesy($this->resource);
    }

    /**
     * @return bool
     */
    public function isLandscape()
    {
        return ($this->getWidth() > $this->getHeight());
    }

    /**
     * @return bool
     */
    public function isPortrait()
    {
        return ($this->getWidth() < $this->getHeight());
    }

    /**
     * @return bool
     */
    public function isJpeg()
    {
        return ($this->type === IMAGETYPE_JPEG);
    }

    /**
     * @return bool
     */
    public function isGif()
    {
        return ($this->type === IMAGETYPE_GIF);
    }

    /**
     * @return bool
     */
    public function isPng()
    {
        return ($this->type === IMAGETYPE_PNG);
    }

    /**
     * @param resource $resource
     */
    private function isResource($resource)
    {
        if (!is_resource($resource)) {
            throw new \LogicException("must be an resource image");
        }
    }
}
