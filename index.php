<?php
include 'Template.php';

$desktop = $_GET['desktop'] ?? 'one';
$cssLinks = ['css/header.css'];
$header = Template::getHtml('header.html');
$params = [
    'header' => $header,
];
$html = '';

switch ($desktop) {
    case 'one':
        $cssLinks[] = 'css/desktop1.css';
        $params['linkCss'] = Template::getCssLinks($cssLinks);

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
