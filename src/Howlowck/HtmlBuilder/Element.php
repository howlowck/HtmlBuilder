<?php namespace Howlowck\HtmlBuilder;

class Element {
    protected $tagname;
    protected $hasContent = false;
    protected $attributes = array();
    protected $content = array();
    public function __construct($tagname = 'div') {
        $this->tagname = $tagname;
        $this->builder = new HtmlBuilder();
        $this->builder->make($this);
    }
    public function hasContent() {
        return $this->hasContent;
    }
    public function getTagname() {
        return $this->tagname;
    }
    public function getAttributes() {
        return $this->attributes;
    }
    public function getContent() {
        return $this->content;
    }
    public function setAttributes($attributes) {
        $this->attributes = is_array($attributes) ? $attributes : array($attributes);
        return $this;
    }
    public function addAttribute($attribute) {
        if (is_array($attribute)) {
            $this->attributes = array_merge($this->attributes, $attribute);
            return $this;
        } elseif (is_empty($attribute)) {
            return $this;
        }
        array_push($this->attributes, $attribute);
        return $this;
    }
    public function setContent($content) {
        $this->content = $content;
        $this->checkContent($content);
        return $this;
    }
    public function addContent($content) {
        if ( ! is_array($this->content)) {
            $this->content = array($this->content);
        }
        array_push($this->content, $content);
        $this->checkContent($content);
        return $this;
    }
    public function getHtml() {
        return $this->builder->getHtml();
    }
    protected function checkContent($content) {
        if (empty($content)) {
            $this->hasContent = false;
            return;
        }
        $this->hasContent = true;
    }
}