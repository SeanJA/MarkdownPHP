<?php

require_once 'PHPUnit/Framework.php';

require_once dirname(__FILE__) . '/../../classes/markdown.php';

/**
 * Test class for Markdown.
 * Generated by PHPUnit on 2010-12-01 at 09:59:39.
 */
class MarkdownTest extends PHPUnit_Framework_TestCase {

  /**
   * @var Markdown
   */
  protected $object;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->object = new Markdown;
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {

  }

  public function test3LevelList(){
    $result = $this->object->transform(file_get_contents('files/3_level_list.md'));
    $this->assertSelectCount('li', 5, $result, '', true);
    $this->assertSelectCount('ul', 3, $result, '', true);
    $this->assertSelectCount('ul > li', 5, $result, '', true);
    //$this->assertXmlStringEqualsXmlFile('files/3_level_list.html', $result);
  }

  public function testBold(){
    $result = $this->object->transform(file_get_contents('files/bold_test.md'));
    $this->assertSelectCount('p', 1, $result, '', true);
    $this->assertSelectCount('p strong', 2, $result, '', true);
    $this->assertSelectCount('strong', 2, $result, '', true);
  }

  public function testItalics(){
    $result = $this->object->transform(file_get_contents('files/italics_test.md'));
    $this->assertSelectCount('p', 1, $result, '', true);
    $this->assertSelectCount('p em', 2, $result, '', true);
    $this->assertSelectCount('em', 2, $result, '', true);
  }

  public function testReadme(){
    $result = $this->object->transform(file_get_contents('files/readme_test.md'));
    $this->assertSelectCount('h1', 1, $result, '', true);
    $this->assertSelectCount('h2', 2, $result, '', true);
    $this->assertSelectCount('h3', 2, $result, '', true);
    $this->assertSelectCount('pre', 3, $result, '', true);
  }

  public function testSingleStringShouldBeSurroundedWithPTag(){
    $result = $this->object->transform(file_get_contents('files/single_string.md'));
    //it has a new line at the end of it
    $this->assertEquals('<p>test</p>'.PHP_EOL, $result);
  }

  public function testInlineHTML(){
    $result = $this->object->transform(file_get_contents('files/inline_html.md'));
    $this->assertSelectCount('button', 1, $result, '', true);
  }

  public function testLinks(){
    $result = $this->object->transform(file_get_contents('files/links_test.md'));
    echo $result;
    $this->assertSelectCount('a', 8, $result, '', true);
    $this->assertSelectCount('p > a', 8, $result, '', true);
    $this->assertSelectCount('a[title=""]', 3, $result, '', true);
    $this->assertSelectCount('a[title="Title"]', 1, $result, '', true);
    $this->assertSelectCount('a[title="Title 1"]', 1, $result, '', true);
    $this->assertSelectCount('a[title="Title 2"]', 2, $result, '', true);
    $this->assertSelectCount('a[title="Title 3"]', 1, $result, '', true);
  }

}