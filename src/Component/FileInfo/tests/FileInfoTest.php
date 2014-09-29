<?php
/**
 * This file is part of the sw_manager.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\StarWarsManager;

use org\bovigo\vfs\vfsStream;
use Star\Component\FileInfo\FileInfo;

/**
 * Class FileInfoTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Compopent\FileInfo
 */
class FileInfoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Star\Component\FileInfo\FileInfo
     */
    private $fileInfo;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $filesystem;

    public function setUp()
    {
        $this->filesystem = $this->getMock('Symfony\Component\Filesystem\Filesystem');

        $this->fileInfo = new FileInfo($this->filesystem);
    }

    public function test_should_initialize_the_filesystem_by_default()
    {
        $this->assertAttributeInstanceOf('Symfony\Component\Filesystem\Filesystem', 'filesystem', new FileInfo());
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage The file 'some-file' could not be found.
     */
    public function test_should_throw_exception_when_file_not_found()
    {
        $this->filesystem
            ->expects($this->once())
            ->method('exists')
            ->willReturn(false);

        $this->fileInfo->getContents('some-file');
    }

    public function test_should_open_the_file()
    {
        $root = vfsStream::setup('root', null, array('some-file' => 'my content'));

        $this->filesystem
            ->expects($this->any())
            ->method('exists')
            ->willReturn(true);

        $this->assertSame('my content', $this->fileInfo->getContents(vfsStream::url('root/some-file')));
    }
}
 