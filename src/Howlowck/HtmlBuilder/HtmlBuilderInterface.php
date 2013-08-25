<?php namespace Howlowck\HtmlBuilder;

interface HtmlBuilderInterface {
    public function make(Element $el);
    public function getHtml();
}