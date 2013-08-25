<?php namespace Howlowck\HtmlBuilder;

class HtmlBuilder {
    protected $element;
    
    public function make(Element $el) {
        $this->element = $el;
        return $this;
    }
    public function getHtml() {
        $startTag = $this->getStartTag();
        $content = $this->getContentString();
        $endTag = $this->getEndTag();
        return $startTag.$content.$endTag;
    }
    public function getStartTag() 
    {
        $string = '<' . $this->element->getTagname();
        $string .= $this->getAttributesString();
        if ( ! $this->element->hasContent() ) {
            return  $string;
        }
        return $string . '>';
    }
    protected function getAttributesString() {
        $string = '';
        if (is_empty($this->element->getAttributes())) {
            return $string;
        }
        $attributes = $this->element->getAttributes();
        if (is_array($attributes)) {
            $i = 0;
            foreach ($attributes as $name => $value) {
                $string .= ($i == 0) ? ' ' : '';
                $string .= is_int($name) ? $value : "$name=\"$value\"";
                $string .= ' ';
                $i++;
            }
        } else {
            $string .= " $attributes ";
        }
        return $string;
    }
    public function getEndTag() 
    {
        if ( ! $this->element->hasContent() ) {
            return '/>';
        }
        return '</' . $this->element->getTagname() . '>';
    }
    public function getContentString()
    {
        $string = '';
        foreach ($this->element->getContent() as $content) {
            if (is_string($content)) {
                $string .= $content;
                continue;
            } elseif ($content instanceof Element) {
                $string .= $content->getHtml();
            }
        }
        return $string;
    } 
    // public function __call($method, $arg)
    // {
    //     if (method_exists($this->element, $method)) {
    //         return $this->element->$method($arg);
    //     }
    //     // if (substr($method, 0, 3) == 'set' and strlen($method) > 3) {
    //     //     $attrName = $this->slugify(substr($method, 3));
    //     //     $this->updateAttributes(array($attrName => $arg[0]));
    //     //     return $this;
    //     // }
    // }
}