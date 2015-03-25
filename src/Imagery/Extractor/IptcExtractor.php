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

namespace Imagery\Extractor;

use Imagery\Data\Collection;

/**
 * Class Iptc
 * @package Imagery\Extractor
 */
final class IptcExtractor implements Extractor
{
    /**
     * {@inheritdoc}
     */
    public function extract($path)
    {
        $data = [];
        $raw = $this->getRawData($path);

        if (is_array($raw) && isset($raw["APP13"])) {

            if ($iptc = iptcparse($raw["APP13"])) {

                $entries = [
                    '2#005'=>'DocumentTitle',
                    '2#010'=>'Urgency',
                    '2#015'=>'Category',
                    '2#020'=>'Subcategories',
                    '2#040'=>'SpecialInstructions',
                    '2#055'=>'CreationDate',
                    '2#080'=>'AuthorByline',
                    '2#085'=>'AuthorTitle',
                    '2#090'=>'City',
                    '2#095'=>'State',
                    '2#101'=>'Country',
                    '2#103'=>'OTR',
                    '2#105'=>'Headline',
                    '2#110'=>'Source',
                    '2#115'=>'PhotoSource',
                    '2#116'=>'Copyright',
                    '2#120'=>'Caption',
                    '2#122'=>'CaptionWriter'
                ];
                foreach ($iptc as $key => $entry) {
                    if (is_array($entry)) {
                        if (array_key_exists($key, $entries)) {
                            $value = implode("|", $entry);
                            $name  = $entries[$key];
                            $data[$name] = mb_convert_encoding($value, "UTF-8");
                        }
                    }
                }
            }
        }
        return new Collection($data);
    }

    /**
     * @param string $path
     * @return array
     */
    private function getRawData($path)
    {
        @getimagesize($path, $data);
        if (!is_array($data)) {
            $data = [];
        }
        return $data;
    }
}
