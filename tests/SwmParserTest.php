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
        $this->assertContentIsReturned('');

        $this->assertSame(array(), $this->parser->parse('some-file'));
    }

    public function test_should_parse_the_header()
    {
        $this->assertContentIsReturned('[header, my]');

        $expected = array(
            'header, my' => array(),
        );
        $this->assertSame($expected, $this->parser->parse(''));
    }

    /**
     * @depends test_should_parse_the_header
     */
    public function test_should_parse_the_attributes()
    {
        $this->assertContentIsReturned(<<<CONTENT
[header, my]\n
attribute1 = 123\r\n
attribute2=ewq\n\r
CONTENT
        );

        $expected = array(
            'header, my' => array(
                'attribute1' => '123',
                'attribute2' => 'ewq',
            ),
        );
        $this->assertSame($expected, $this->parser->parse(''));
    }

    /**
     * @depends test_should_parse_the_attributes
     */
    public function test_should_remove_html_from_attribute()
    {
        $this->assertContentIsReturned(<<<CONTENT
[header]
attribute=<FONT size=2>I am a multi line content </FOnt>
CONTENT
        );

        $expected = array(
            'header' => array(
                'attribute' => 'I am a multi line content',
            ),
        );
        $this->assertEquals($expected, $this->parser->parse(''));
    }

    /**
     * @depends test_should_parse_the_header
     *
     * @expectedException        \RuntimeException
     * @expectedExceptionMessage The file could not be parsed correctly.
     */
    public function test_should_throw_exception_when_data_is_invalid()
    {
        $this->assertContentIsReturned(<<<CONTENT
no-header-error=123
CONTENT
        );
        $this->parser->parse('');
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getMockFileInfo()
    {
        return $this->getMock('Star\Component\FileInfo\FileInfo');
    }

    private function assertContentIsReturned($content)
    {
        $this->fileInfo
            ->expects($this->once())
            ->method('getContents')
            ->willReturn($content);
    }
}
 