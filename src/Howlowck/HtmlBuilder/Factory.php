<?php namespace Howlowck\HtmlBuilder;

class Factory {
    public function make($tagname = 'div') {
        return new Element($tagname);
    }
}