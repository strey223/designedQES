<?php

class Template
{
    protected $templateContent;
    protected $content;
    protected $params;

    public function __construct($nameFile, $params = [], $path = __DIR__ . '/../html/')
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

    public static function getHtml($nameFile, $params = [], $path = __DIR__ . '/../html/')
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
    public static function getJsScripts($getJsScripts)
    {
        $textLinks = '';
        foreach($getJsScripts as $getJsScript) {
            $textLinks .=  "<script type=\"text/javascript\" src=\"$getJsScript\"></script>";
        }
        return $textLinks;
    }

    protected static function getHtmlStepBox($vectors)
    {
        $classes = [
            'step-first',
            'step-second no-first',
            'step-third no-first',
            'step-fourth no-first',
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
            $vectors[4] = 'vector4.svg';
        }

        return self::getHtmlStepBox($vectors);
    }

    public static function getFormatingHtmlStepNumber($step = 1)
    {
        $classes = [
            'step-first',
            'step-second no-first',
            'step-third no-first',
            'step-fourth no-first',
            'step-fifth',
        ];
        $texts = [
            'Шаг 1. Проверка ПО',
            'Шаг 2. Запрос сертификата',
            'Шаг 3. Выпуск сертификата',
            'Шаг 4. Подписание бланка',
            'Шаг 5. Запись сертификата',
        ];

        $html = '';
        foreach ($texts as $number => $text) {
            $class = $classes[$number] ?? '';

            if ($number + 1 == $step) {
                $class .= ' select';
            }
            $html .= "<span class=\"$class\"> $text </span>";
        }

        return $html;
    }

    public static function getStepText($step = 1)
    {
        $textsStep = [
            'Внимание! Генерация сертификата возможна только на операционной системе Windows.
                Для генерации электронной подписи потребуется установка программного обеспечения.
                Во время установки ПО, на все вопросы отвечайте “Да”.',
            'Для продолжения работы, сайту потребуется предоставить доступ к информации о ваших сертификатах. 
                Нажав “Запросить доступ”, появится окно, в котором следует нажать “Предоставить доступ”.',
            'Запрос на выдачу сертификата отправлен в удостоверяющий центр. Обновите страницу, для статуса отслеживания сертификата.',
            'Запрос на выдачу сертификата отправлен в удостоверяющий центр. Обновите страницу, для статуса отслеживания сертификата.',
            'Ваш сертификат готов. Чтобы его получить следуйте инструкции.',
            'Обязательно запишите сертификат на ключевой носитель',
            'Сертификат записан в контейнер Полное рукодство по настройке ПК для работы с электронной подписью',
        ];

        return $textsStep[$step - 1];
    }

    public static function getDivButtonStep($step = 1)
    {
        $buttonsStep = [[
                'name' => 'loadSoftware',
                'text' => 'Загрузить ПО',
            ], [
                'name' => 'requestAccess',
                'text' => 'Запросить доступ',
            ], [
                'name' => 'updatePage',
                'text' => 'Обновить страницу',
            ], [
                'name' => 'updatePage',
                'text' => 'Обновить страницу',
            ], [],
            [
                'name' => 'write',
                'text' => 'Записать',
            ], [
                'class' => 'white',
                'name'  => 'instruction',
                'text'  => 'Инструкция'
            ],
        ];

        $buttonInfo = $buttonsStep[$step - 1];

        if (!$buttonInfo) {
            return '';
        }
        $name = '';
        $text = '';
        $class =  '';

        if (!empty($buttonInfo['class'])) {
            $class = $buttonInfo['class'];
            $class = "class=\"$class\"";
        }
        if (!empty($buttonInfo['text'])) {
            $text = $buttonInfo['text'];
            $text = "value=\"$text\"";
        }

        if (!empty($buttonInfo['name'])) {
            $name = $buttonInfo['name'];
            $name = "$name=\"$class\"";
        }

        return "<div class='divButtonStep'> <input type='button' $class $name $text> </div>";

    }

}