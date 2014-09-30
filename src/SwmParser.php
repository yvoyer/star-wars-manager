<?php
/**
 * This file is part of the sw_manager.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\StarWarsManager;

use Star\Component\FileInfo\FileInfo;

/**
 * Class SwmParser
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\StarWarsManager
 */
class SwmParser
{
    /**
     * @var FileInfo
     */
    private $fileInfo;

    /**
     * @param FileInfo $fileInfo
     */
    public function __construct(FileInfo $fileInfo = null)
    {
        if (null === $fileInfo) {
            $fileInfo = new FileInfo();
        }

        $this->fileInfo = $fileInfo;
    }

    /**
     * @param string $filePath
     *
     * @throws \InvalidArgumentException
     * @return array
     */
    public function parse($filePath)
    {
        if (false == $this->fileInfo->exists($filePath)) {
            throw new \InvalidArgumentException("The file '{$filePath}' could not be found.");
        }

        $content = $this->fileInfo->getContents($filePath);
        if (empty($content)) {
            return array();
        }

        $handle = fopen('php://memory', 'r+');
        fputs($handle, $content);
        rewind($handle);

        $data = array();
        $currentHeader = null;
        $row = null;
        while (true) {
            $line = fgets($handle);

            // header should be first string
            if (false !== strpos($line, '[', 0)) {
                $row = new FileData($line);
                $data[] = $row;
                continue;
            }

            if (false === $row instanceof FileData) {
                throw new \RuntimeException('The file could not be parsed correctly.');
            }

            // Line header's attributes
            if (false !== strpos($line, '=')) {
                $attributeData = explode('=', $line);
                $row->addAttribute(trim($attributeData[0]), trim($attributeData[1]));
                continue;
            }

            if (!$line) {
                break;
            }
        }
        fclose($handle);

        $formattedData = array();
        foreach ($data as $line) {
            /**
             * @var FileData $line
             */
            $formattedData[$line->getHeader()] = $line->getAttributes();
        }

        return $formattedData;
    }
}

class FileData
{
    /**
     * @var string
     */
    private $header;

    /**
     * @var array
     */
    private $attributes = array();

    /**
     * @param $header
     */
    public function __construct($header)
    {
        $this->header = $this->sanitize($header);
    }

    /**
     * @param $key
     * @param $value
     */
    public function addAttribute($key, $value)
    {
        $this->attributes[$key] = $this->sanitize($value);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            $this->header => $this->attributes,
        );
    }

    /**
     * Returns the Attributes.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Returns the Header.
     *
     * @return string
     */
    public function getHeader()
    {
        return $this->header;
    }

    private function sanitize($string)
    {
        return trim(str_replace(array('[', ']', "\n", "\r", "\t"), '', $string));
    }
}