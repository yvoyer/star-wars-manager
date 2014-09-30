<?php
/**
 * This file is part of the sw_manager.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\FileInfo;

use Symfony\Component\Filesystem\Filesystem;

/**
 * Class FileInfo
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\FileInfo
 */
class FileInfo
{
    /**
     * @var \Symfony\Component\Filesystem\Filesystem
     */
    private $filesystem;

    /**
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem = null)
    {
        if (null === $filesystem) {
            $filesystem = new Filesystem();
        }

        $this->filesystem = $filesystem;
    }

    /**
     * @param string $path
     *
     * @throws \InvalidArgumentException
     *
     * @return string
     */
    public function getContents($path)
    {
        if (false === $this->exists($path)) {
            throw new \InvalidArgumentException("The file '{$path}' could not be found.");
        }

        return file_get_contents($path);
    }

    /**
     * @param string $path
     *
     * @return bool
     */
    public function exists($path)
    {
        return $this->filesystem->exists($path);
    }
}
 