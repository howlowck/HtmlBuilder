<?php 
use Howlowck\HtmlBuilder\Element;
class ElementTest extends PHPUnit_Framework_TestCase {
    public function testCreateInstance() {
        $el = new Element('ul');
        $this->assertInstanceOf('Howlowck\HtmlBuilder\Element', $el);
    }
    public function testAddAttributeArrayToEmpty() {
        $el = new Element('div');
        $el->addAttribute(array('class' => 'foo'));
        $this->assertEquals(array('class'=> 'foo'), $el->getAttributes());
    }
    public function testAddAttributePropertyToEmpty() {
        $el = new Element('div');
        $el->addAttribute('foo');
        $this->assertEquals(array('foo'), $el->getAttributes());
    }
    public function testAddAttributeArrayToExisting() {
        $el = new Element('div');
        $el->addAttribute(array('id' => 'bar'));
        $el->addAttribute(array('class' => 'foo'));
        $this->assertEquals(array('id' => 'bar', 'class'=> 'foo'), $el->getAttributes());
    }
    public function testAddAttributePropertyToExisting() {
        $el = new Element('input');
        $el->addAttribute(array('id' => 'bar'));
        $el->addAttribute(array('required'));
        $this->assertEquals(array('id' => 'bar', 'required'), $el->getAttributes());
    }
    public function testAddAttributeEmptyStringToExisting() {
        $el = new Element('input');
        $el->addAttribute(array('id' => 'bar'));
        $el->addAttribute('');
        $this->assertEquals(array('id' => 'bar'), $el->getAttributes());
    }
    public function testSetAttributesArray() {
        $el = new Element('div');
        $el->setAttributes(array('id' => 'wow'));
        $this->assertEquals(array('id' => 'wow'), $el->getAttributes());
    }
    public function testGetTagname() {
        $el = new Element('ul');
        $this->assertEquals('ul', $el->getTagname());
    }
    public function testSetContentString() {
        $el = new Element('p');
        $el->setContent('Hello!');
        $this->assertEquals('Hello!', $el->getContent());
    }
    public function testSetContentElement() {
        $el = new Element('ul');
        $li = new Element('li');
        $el->setContent($li);
        $this->assertInstanceOf('Howlowck\HtmlBuilder\Element', $el->getContent());
    }
    public function testAddContentString() {
        $el = new Element('ul');
        $li = new Element('li');
        $el->setContent($li);
        $el->addContent('hi');
        $this->assertInstanceOf('Howlowck\HtmlBuilder\Element', $el->getContent()[0]);
        $this->assertEquals('hi', $el->getContent()[1]);
    }
    public function testHasContentInitial() {
        $el = new Element('ul');
        $this->assertEquals(false, $el->hasContent());
    }
    public function testHasContentAfterSetContent() {
        $el = new Element('ul');
        $li = new Element('li');
        $el->setContent($li);
        $this->assertEquals(true, $el->hasContent());
    }
    public function testHasContentAfterAddContent() {
       $el = new Element('ul');
       $li = new Element('li');
       $el->addContent('hi');
       $this->assertEquals(true, $el->hasContent());
    }
    public function testHasContentAfterSetEmptyContent() {
       $el = new Element('ul');
       $li = new Element('li');
       $el->setContent(array());
       $this->assertEquals(false, $el->hasContent());
    }
    public function testGetHtmlWithNothing() {
        $el = new Element('li');
        $this->assertEquals('<li/>', $el->getHtml());
    }
    public function testGetHtmlWithAttributeStrings() {
        $el = new Element('input');
        $el->addAttribute('checked');
        $el->addAttribute('required');
        $this->assertEquals('<input checked required />', $el->getHtml());
    }
    public function testGetHtmlWithAttributeArrays() {
        $el = new Element('li');
        $el->addAttribute(array('id' => 'foo'));
        $el->addAttribute(array('class' => 'bar'));
        $this->assertEquals('<li id="foo" class="bar" />', $el->getHtml());
    }
    public function testGetHtmlWithAttributeMixed() {
        $el = new Element('li');
        $el->setAttributes(array('id' => 'foo', 'checked'));
        $el->addAttribute('required');
        $this->assertEquals('<li id="foo" checked required />', $el->getHtml());
    }
    public function testGetHtmlWithInternalElement() {
        $el = new Element('ul');
        $li1 = new Element('li');
        $li2 = new Element('li');
        $li2->addAttribute('required');
        $el->addContent($li1);
        $el->addContent($li2);
        $this->assertEquals('<ul><li/><li required /></ul>', $el->getHtml());
    }
    public function testGetHtmlWithInternalElementMixed() {
        $el = new Element('ul');
        $li1 = new Element('li');
        $li2 = new Element('li');
        $li2->addAttribute('required');
        $el->addContent($li1);
        $el->addContent($li2);
        $el->addContent(' hi!!!');
        $this->assertEquals('<ul><li/><li required /> hi!!!</ul>', $el->getHtml());
    }
}