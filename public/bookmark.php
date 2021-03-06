<?php

require_once dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'bittorrent.php';
require_once INCL_DIR . 'user_functions.php';
require_once INCL_DIR . 'html_functions.php';
check_user_status();
global $CURUSER;

$lang = array_merge(load_language('global'), load_language('bookmark'));

$HTMLOUT = '';
if (!mkglobal('torrent')) {
    stderr($lang['bookmark_err'], $lang['bookmark_missing']);
}
$userid = (int) $CURUSER['id'];
if (!is_valid_id($userid)) {
    stderr($lang['bookmark_err'], $lang['bookmark_invalidid']);
}
if ($userid != $CURUSER['id']) {
    stderr($lang['bookmark_err'], $lang['bookmark_denied']);
}
$torrentid = (int) $_GET['torrent'];
if (!is_valid_id($torrentid)) {
    die();
}
if (!isset($torrentid)) {
    stderr($lang['bookmark_err'], $lang['bookmark_failtorr']);
}
$possible_actions = [
    'add',
    'delete',
    'public',
    'private',
];
$action = (isset($_GET['action']) ? htmlsafechars($_GET['action']) : '');
if (!in_array($action, $possible_actions)) {
    stderr($lang['bookmark_err'], $lang['bookmark_aruffian']);
}
if ($action === 'add') {
    $torrentid = (int) $_GET['torrent'];
    $sure = isset($_GET['sure']) ? (int) $_GET['sure'] : '';
    if (!is_valid_id($torrentid)) {
        stderr($lang['bookmark_err'], $lang['bookmark_invalidid']);
    }
    $hash = md5('s5l6t0mu55yt4hwa7e5' . $torrentid . 'add' . 's5l6t0mu55yt4hwa7e5');
    if (!$sure) {
        stderr($lang['bookmark_add'], $lang['bookmark_add_click'] . "<a href='?torrent=$torrentid&amp;action=add&amp;sure=1&amp;h=$hash'>{$lang['bookmark_here']}</a>{$lang['bookmark_sure']}", false);
    }
    if ($_GET['h'] != $hash) {
        stderr($lang['bookmark_err'], $lang['bookmark_waydoing']);
    }
    /**
     * @param $torrentid
     */
    function addbookmark($torrentid)
    {
        global $CURUSER, $lang, $cache;

        if ((get_row_count('bookmarks', 'WHERE userid=' . sqlesc($CURUSER['id']) . ' AND torrentid = ' . sqlesc($torrentid))) > 0) {
            stderr($lang['bookmark_err'], $lang['bookmark_already']);
        }
        sql_query('INSERT INTO bookmarks (userid, torrentid) VALUES (' . sqlesc($CURUSER['id']) . ', ' . sqlesc($torrentid) . ')') or sqlerr(__FILE__, __LINE__);
        $cache->delete('bookmm_' . $CURUSER['id']);
        make_bookmarks($CURUSER['id'], 'bookmm_');
    }

    $HTMLOUT .= addbookmark($torrentid);
    $HTMLOUT .= "<h2>{$lang['bookmark_added']}</h2>";
}
if ($action === 'delete') {
    $torrentid = (int) $_GET['torrent'];
    $sure = isset($_GET['sure']) ? (int) $_GET['sure'] : '';
    if (!is_valid_id($torrentid)) {
        stderr($lang['bookmark_err'], $lang['bookmark_invalidid']);
    }
    $hash = md5('s5l6t0mu55yt4hwa7e5' . $torrentid . 'delete' . 's5l6t0mu55yt4hwa7e5');
    if (!$sure) {
        stderr($lang['bookmark_delete'], $lang['bookmark_del_click'] . "<a href='?torrent=$torrentid&amp;action=delete&amp;sure=1&amp;h=$hash'>{$lang['bookmark_here']}</a>{$lang['bookmark_sure']}", false);
    }
    if ($_GET['h'] != $hash) {
        stderr($lang['bookmark_err'], $lang['bookmark_waydoing']);
    }
    /**
     * @param $torrentid
     */
    function deletebookmark($torrentid)
    {
        global $CURUSER, $cache;

        sql_query('DELETE FROM bookmarks WHERE torrentid = ' . sqlesc($torrentid) . ' AND userid = ' . sqlesc($CURUSER['id']));
        $cache->delete('bookmm_' . $CURUSER['id']);
        make_bookmarks($CURUSER['id'], 'bookmm_');
    }

    $HTMLOUT .= deletebookmark($torrentid);
    $HTMLOUT .= "<h2>{$lang['bookmark_deleted']}</h2>";
} elseif ($action === 'public') {
    $torrentid = (int) $_GET['torrent'];
    $sure = isset($_GET['sure']) ? (int) $_GET['sure'] : '';
    if (!is_valid_id($torrentid)) {
        stderr('Error', 'Invalid ID.');
    }
    $hash = md5('s5l6t0mu55yt4hwa7e5' . $torrentid . 'public' . 's5l6t0mu55yt4hwa7e5');
    if (!$sure) {
        stderr($lang['bookmark_share'], $lang['bookmark_share_click'] . "<a href='?torrent=$torrentid&amp;action=public&amp;sure=1&amp;h=$hash'>{$lang['bookmark_here']}</a>{$lang['bookmark_sure']}", false);
    }
    if ($_GET['h'] != $hash) {
        stderr($lang['bookmark_err'], $lang['bookmark_waydoing']);
    }
    /**
     * @param $torrentid
     */
    function publickbookmark($torrentid)
    {
        global $CURUSER, $cache;

        sql_query("UPDATE bookmarks SET private = 'no' WHERE private = 'yes' AND torrentid = " . sqlesc($torrentid) . ' AND userid = ' . sqlesc($CURUSER['id']));
        $cache->delete('bookmm_' . $CURUSER['id']);
        make_bookmarks($CURUSER['id'], 'bookmm_');
    }

    $HTMLOUT .= publickbookmark($torrentid);
    $HTMLOUT .= "<h2>{$lang['bookmark_public']}</h2>";
} elseif ($action === 'private') {
    $torrentid = (int) $_GET['torrent'];
    $sure = isset($_GET['sure']) ? (int) $_GET['sure'] : '';
    if (!is_valid_id($torrentid)) {
        stderr($lang['bookmark_err'], $lang['bookmark_invalidid']);
    }
    $hash = md5('s5l6t0mu55yt4hwa7e5' . $torrentid . 'private' . 's5l6t0mu55yt4hwa7e5');
    if (!$sure) {
        stderr($lang['bookmark_make_private'], $lang['bookmark_click_private'] . "<a href='?torrent=$torrentid&amp;action=private&amp;sure=1&amp;h=$hash'>{$lang['bookmark_here']}</a>{$lang['bookmark_sure']}", false);
    }
    if ($_GET['h'] != $hash) {
        stderr($lang['bookmark_err'], $lang['bookmark_waydoing']);
    }
    if (!is_valid_id($torrentid)) {
        stderr($lang['bookmark_err'], $lang['bookmark_invalidid']);
    }
    /**
     * @param $torrentid
     */
    function privatebookmark($torrentid)
    {
        global $CURUSER, $cache;

        sql_query("UPDATE bookmarks SET private = 'yes' WHERE private = 'no' AND torrentid = " . sqlesc($torrentid) . ' AND userid = ' . sqlesc($CURUSER['id']));
        $cache->delete('bookmm_' . $CURUSER['id']);
        make_bookmarks($CURUSER['id'], 'bookmm_');
    }

    $HTMLOUT .= privatebookmark($torrentid);
    $HTMLOUT .= "<h2>{$lang['bookmark_private']}</h2>";
}
if (isset($_POST['returnto'])) {
    $ret = '<a href="' . htmlsafechars($_POST['returnto']) . "\">{$lang['bookmark_goback']}</a>";
} else {
    $ret = "<a href=\"bookmarks.php\">{$lang['bookmark_goto']}</a><br><br>
    <a href=\"browse.php\">{$lang['bookmark_goto_browse']}</a>";
}
$HTMLOUT .= $ret;
echo stdhead($lang['bookmark_stdhead']) . wrapper($HTMLOUT) . stdfoot();
