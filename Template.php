<?php

class Template
{
    protected $template;
    protected $content;

    public function __construct($templateFile)
    {
        $content = file_get_contents($templateFile);
    }
}