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
    public function getMime()
    {
        return image_type_to_mime_type($this->type);
    }

    /**
     * @return int
     */
    public function getType()
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
     * @param resource $resource
     */
    private function isResource($resource)
    {
        if (!is_resource($resource)) {
            throw new \LogicException("must be an resource image");
        }
    }
}
