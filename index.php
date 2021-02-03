<?php
include 'class/Template.php';
include 'class/TemplateAdditionalInfo.php';

$desktop = $_GET['desktop'] ?? 'one';
$cssLinks = ['css/header.css', 'css/modal.css'];
$jsScripts = ['js/desktop.js'];
$params = [
    'header' => Template::getHtml('header.html'),
    'modal'  => Template::getHtml('modal.html'),
    'infoCertificate' => 'ООО Айтиком, заявка ЕПГУ №681941 Юрченко Елена Анатольевна',
];
$html = '';
$step = 1;
if (in_array($step, [2, 3, 4,])) {
    $cssLinks[] = 'css/detailsInfoStepCertificate.css';
    $params['detailsInfoStepCertificate'] = Template::getHtml('detailsInfoStepCertificate.html');
}

if ($step == 5) {
    $cssLinks[] = 'css/writeAndDownloadDocument.css';

    $params['writeAndDownloadDocument'] = Template::getHtml('writeAndDownloadDocument.html');
}

if ($step == 6) {
    $cssLinks[] = 'css/saveCertificate.css';
    $params['writeAndDownloadDocument'] = Template::getHtml('saveCertificate.html');
}

switch ($desktop) {
    case 'one':
        $cssLinks[] = 'css/desktop1.css';
        $params['linkCss'] = Template::getCssLinks($cssLinks);
        $params['scriptJs'] = Template::getJsScripts($jsScripts);
        $params['boxInfo'] = Template::getFormatingHtmlStepBox(1);
        $params['stepInfo'] = Template::getFormatingHtmlStepNumber(1);
        $params['textStep'] = Template::getStepText(1);
        $params['divButtonStep'] = Template::getDivButtonStep(1);

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
