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
     * @param string $file
     *
     * @throws \InvalidArgumentException
     * @return array
     */
    public function parse($file)
    {
        if (false == $this->fileInfo->exists($file)) {
            throw new \InvalidArgumentException("The file '{$file}' could not be found.");
        }

        // todo Hide file loading behind adapter
        $content = $this->fileInfo->getContents($file);

        return array();
    }
}
 