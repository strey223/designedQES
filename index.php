<?php
include 'Template.php';

$desktop = $_GET['desktop'] ?? 'one';
$cssLinks = ['css/header.css'];
$jsScripts = ['js/desktop.js'];
$header = Template::getHtml('header.html');
$params = [
    'header' => $header,
    'infoCertificate' => 'ООО Айтиком, заявка ЕПГУ №681941 Юрченко Елена Анатольевна',
];
$html = '';

switch ($desktop) {
    case 'one':
        $cssLinks[] = 'css/desktop1.css';
        $params['linkCss'] = Template::getCssLinks($cssLinks);
        $params['scriptJs'] = Template::getJsScripts($jsScripts);
        $params['boxInfo'] = Template::getFormatingHtmlStepBox(2);
        $params['stepInfo'] = Template::getFormatingHtmlStepNumber(2);
        $params['textStep'] = Template::getStepText(2);
        $params['divButtonStep'] = Template::getDivButtonStep(7);

        $html = Template::getHtml('desktop1.html', $params);
        break;
    case 'two':
        $cssLinks = 'css/desktop2.css';

        $html = Template::getHtml('desktop2.html');

        break;
    default:
        $html = Template::getHtml('notFound.html');
}

echo $html;
