<?php
$key = 'VGhlIE1vemlsbGEgZmFtaWx5IGFwcG';
$vars = [
    'ircidle'  => '',
    'username' => '',
    'key'      => '',
    'do'       => '',
];
foreach ($vars as $k => $v) {
    $vars[$k] = isset($_GET[$k]) ? $_GET[$k] : '';
}
if ($key !== $vars['key'] || empty($vars['username'])) {
    die('hmm something looks odd');
}
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'bittorrent.php';
dbconn();
switch ($vars['do']) {
    case 'check':
        $q = sql_query('SELECT id FROM users WHERE username = ' . sqlesc($vars['username']));
        echo mysqli_num_rows($q);
        break;

    case 'idle':
        sql_query('UPDATE users SET onirc = ' . sqlesc(!$vars['ircidle'] ? 'no' : 'yes') . ' WHERE username = ' . sqlesc($vars['username']));
        echo mysqli_affected_rows($GLOBALS['___mysqli_ston']);
        break;

    default:
        die('hmm something looks odd again');
}
die();
