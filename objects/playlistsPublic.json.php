<?php
global $global, $config;
if (!isset($global['systemRootPath'])) {
    require_once '../videos/configuration.php';
}
if (!User::isLogged()) {
    die();
}
require_once $global['systemRootPath'] . 'objects/playlist.php';
header('Content-Type: application/json');
session_write_close();
setRowCount(10);
//mysqlBeginTransaction();
$row = PlayList::getAll('public', @$_REQUEST['Playlists_id']);
//mysqlCommit();
echo json_encode($row);
