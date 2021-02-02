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

    protected static function getHtmlStepBox($vectors)
    {
        $classes = [
            'step-first',
            'step-second',
            'step-third',
            'step-fourth',
            'step-fifth',
        ];

        $html = '';
        foreach ($vectors as $number => $vector) {
            $class = $classes[$number] ?? '';
            $html .= "<img class=\"$class\" src=\"picture/$vector\">";
        }

        return $html;
    }

    public static function getFormatingHtmlStepBox($step = 1)
    {
        $vectors = [
            'vector.svg',
            'vector1.svg',
            'vector1.svg',
            'vector1.svg',
            'vector3.svg',
        ];

        if ($step > 1) {
            $vectors[1] = 'vector2.svg';
        }
        if ($step > 2) {
            $vectors[2] = 'vector2.svg';
        }
        if ($step > 3) {
            $vectors[3] = 'vector2.svg';
        }
        if ($step > 4) {
            $vectors[4] = 'vector5.svg';
        }

        return self::getHtmlStepBox($vectors);
    }

}