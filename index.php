<?php
$desktop = $_GET['desktop'] ?? 'one';

switch ($desktop) {
    case 'one':
        include './html/desktop1.html';
        break;
    case 'two':
        include './html/desktop2.html';
        break;
    default:
        include './html/desktop1.html';
}
// полезной информции в заголовке 1140