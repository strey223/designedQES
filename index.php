<?php
$desktop = $_GET['desktop'] ?? 'one';

switch ($desktop) {
    case 'one':
        $hello = file_get_contents('./html/desktop1.html');
        echo $hello;
        break;
    case 'two':
        $hello2 = file_get_contents('./html/desktop2.html');
        echo $hello2;

        break;
    default:
        include './html/desktop1.html';
}
// полезной информции в заголовке 1140