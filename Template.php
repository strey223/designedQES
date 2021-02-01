<?php

class Template
{
    protected $templateContent;
    protected $content;
    protected $params;

    public function __construct($nameFile, $params = [], $path = __DIR__ . '/html/')
    {
        $templateFile = $path . $nameFile;

        if (!is_file($templateFile)) {
            throw new Exception('Не найден файл ' . $templateFile);
        }

        $templateContent = file_get_contents($templateFile);

        $this->templateContent = $templateContent;
        $this->params = $params;
    }

    public function getHtmlInfo()
    {
        if ($this->content) {
            return $this->content;
        }

        $this->templateContent;
        if (!$this->templateContent) {
            return '';
        }
        $params = $this->params;
        $this->templateContent = preg_replace_callback('/\{(.+?)\}/m', function ($matches) use($params)  {
            if (isset($params[$matches[1]])) {
                return $params[$matches[1]];
            }
            return '';
        }, $this->templateContent);

        return $this->templateContent;
    }

    public static function getHtml($nameFile, $params = [], $path = __DIR__ . '/html/')
    {
        $template =  new static($nameFile, $params, $path);

        return $template->getHtmlInfo();
    }

    public static function getCssLinks($addressLinks)
    {
        $textLinks = '';
        foreach($addressLinks as $addressLink) {
            $textLinks .=  "<link rel=\"stylesheet\" href=\"$addressLink\">";
        }
        return $textLinks;
    }
}