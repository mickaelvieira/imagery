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
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @var string
     */
    private $mimeType;

    /**
     * @var int
     */
    private $imageType;

    /**
     * @var \Imagery\DataCollection
     */
    private $iptc;

    /**
     * @var \Imagery\DataCollection
     */
    private $exif;

    /**
     * @param string $file_name
     */
    public function __construct($file_name)
    {
        parent::__construct($file_name);

        $info = @getimagesize($this->getPathname(), $iptc);

        if (!$info) {
            throw new \LogicException(sprintf("File %s is not an image", $this->getPathname()));
        }

        $this->width     = $info[0];
        $this->height    = $info[1];
        $this->imageType = $info[2];
        $this->mimeType  = $info['mime'];

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
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * @return int
     */
    public function getImageType()
    {
        return $this->imageType;
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
        return ($this->width > $this->height);
    }

    /**
     * @return bool
     */
    public function isPortrait()
    {
        return ($this->width < $this->height);
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
        return ($this->imageType === IMAGETYPE_JPEG);
    }

    /**
     * @return bool
     */
    public function isGif()
    {
        return ($this->imageType === IMAGETYPE_GIF);
    }

    /**
     * @return bool
     */
    public function isPng()
    {
        return ($this->imageType === IMAGETYPE_PNG);
    }

    /**
     * @return null|resource
     */
    public function getResource()
    {
        if ($this->isJpeg()) {
            $resource = imagecreatefromjpeg($this->getPathname());
        } elseif ($this->isGif()) {
            $resource = imagecreatefromgif($this->getPathname());
        } elseif ($this->isPng()) {
            $resource = imagecreatefrompng($this->getPathname());
        } else {
            throw new \LogicException("Cannot generate resource, file type must be JPEG, GIF, PNG");
        }
        return $resource;
    }
}
