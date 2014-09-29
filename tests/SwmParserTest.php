<?php
/**
 * This file is part of the sw_manager.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\StarWarsManager;

/**
 * Class SwmParserTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\StarWarsManager
 */
class SwmParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|\Star\Component\FileInfo\FileInfo
     */
    private $fileInfo;

    /**
     * @var SwmParser
     */
    private $parser;

    public function setUp()
    {
        $this->fileInfo = $this->getMockFileInfo();
        $this->fileInfo
            ->expects($this->any())
            ->method('exists')
            ->willReturn(true);

        $this->parser = new SwmParser($this->fileInfo);
    }

    public function test_should_initialize_the_filesystem_by_default()
    {
        $this->assertAttributeInstanceOf('Star\Component\FileInfo\FileInfo', 'fileInfo', new SwmParser());
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage The file 'some-file' could not be found.
     */
    public function test_should_throw_exception_when_file_not_found()
    {
        $this->fileInfo = $this->getMockFileInfo();
        $this->fileInfo
            ->expects($this->once())
            ->method('exists')
            ->willReturn(false);

        $this->parser = new SwmParser($this->fileInfo);
        $this->parser->parse('some-file');
    }

    public function test_should_open_the_file()
    {
        $this->fileInfo
            ->expects($this->once())
            ->method('getContents')
            ->willReturn('');

        $this->assertSame(array(), $this->parser->parse('some-file'));
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getMockFileInfo()
    {
        return $this->getMock('Star\Component\FileInfo\FileInfo');
    }
}
 