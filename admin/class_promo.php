<?php

require_once CLASS_DIR.'class_check.php';
$class = get_access(basename($_SERVER['REQUEST_URI']));
class_check($class);
global $CURUSER, $site_config, $lang;

$lang = array_merge($lang, load_language('ad_class_promo'));
//== ID list - Add individual user IDs to this list for access to this script
/*$allowed_ids = array(
1
); //== 1 Is Sysop*/
if (!in_array($CURUSER['id'], $site_config['is_staff']['allowed'] /*$allowed_ids*/)) {
    stderr($lang['classpromo_error'], $lang['classpromo_denied']);
}
$pconf = sql_query('SELECT * FROM class_promo ORDER BY id ASC ') or sqlerr(__FILE__, __LINE__);
while ($ac = mysqli_fetch_assoc($pconf)) {
    $class_config[$ac['name']]['id'] = $ac['id'];
    $class_config[$ac['name']]['name'] = $ac['name'];
    $class_config[$ac['name']]['min_ratio'] = $ac['min_ratio'];
    $class_config[$ac['name']]['uploaded'] = $ac['uploaded'];
    $class_config[$ac['name']]['time'] = $ac['time'];
    $class_config[$ac['name']]['low_ratio'] = $ac['low_ratio'];
}
$possible_modes = [
    'add',
    'edit',
    'remove',
    '',
];
$mode = (isset($_GET['mode']) ? htmlsafechars($_GET['mode']) : '');
if (!in_array($mode, $possible_modes)) {
    stderr($lang['classpromo_error'], $lang['classpromo_ruffian']);
}
if ('POST' == $_SERVER['REQUEST_METHOD']) {
    if ('edit' == $mode) {
        foreach ($class_config as $c_name => $value) {
            // handing from database
            $c_value = $value['id']; // $key is like 0, 1, 2 etc....
            $c_name = strtoupper($value['name']);
            $c_min_ratio = $value['min_ratio'];
            $c_uploaded = $value['uploaded'];
            $c_time = $value['time'];
            $c_low_ratio = $value['low_ratio'];
            // handling from posting of contents
            $post_data = $_POST[$c_name]; //    0=> name,1=>min_ratio,2=>uploaded,3=>time,4=>low_ratio
            $value = $post_data[0];
            $name = $post_data[1];
            $min_ratio = strtoupper($post_data[2]);
            $uploaded = $post_data[3];
            $time = $post_data[4];
            $low_ratio = $post_data[5];

            if (isset($_POST[$c_name][0]) && (($value != $c_value) || ($name != $c_name) || ($min_ratio != $c_min_ratio) || ($uploaded != $c_uploaded) || ($time != $c_time) || ($low_ratio != $c_low_ratio))) {
                $update[$c_name] = '('.sqlesc($c_name).','.sqlesc(is_array($min_ratio) ? join('|', $min_ratio) : $min_ratio).','.sqlesc(is_array($uploaded) ? join('|', $uploaded) : $uploaded).','.sqlesc(is_array($time) ? join('|', $time) : $time).','.sqlesc(is_array($low_ratio) ? join('|', $low_ratio) : $low_ratio).')';
            }
        }
        if (sql_query('INSERT INTO class_promo(name,min_ratio,uploaded,time,low_ratio) VALUES '.join(',', $update).' ON DUPLICATE KEY UPDATE name = VALUES(name),min_ratio = VALUES(min_ratio),uploaded = VALUES(uploaded),time = VALUES(time),low_ratio = VALUES(low_ratio)')) { // need to change strut
            stderr($lang['classpromo_success'], $lang['classpromo_success_saved']);
        } else {
            stderr($lang['classpromo_error'], $lang['classpromo_err_query1']);
        }
        exit;
    }

    //ADD CLASS
    if ('add' == $mode) {
        print_r($_POST, true);
        $name = isset($_POST['name']) ? htmlsafechars($_POST['name']) : stderr($lang['classpromo_error'], $lang['classpromo_err_clsname']);
        $min_ratio = isset($_POST['min_ratio']) ? $_POST['min_ratio'] : stderr($lang['classpromo_error'], $lang['classpromo_err_minratio']);
        $uploaded = isset($_POST['uploaded']) ? (int) $_POST['uploaded'] : stderr($lang['classpromo_error'], $lang['classpromo_err_upl']);
        $time = isset($_POST['time']) ? (int) $_POST['time'] : stderr($lang['classpromo_error'], $lang['classpromo_err_time']);
        $low_ratio = isset($_POST['low_ratio']) ? $_POST['low_ratio'] : stderr($lang['classpromo_error'], $lang['classpromo_err_lowratio']);

        if (sql_query('INSERT INTO class_promo (name, min_ratio,uploaded,time,low_ratio) VALUES('.sqlesc($name).','.sqlesc($min_ratio).','.sqlesc($uploaded).','.sqlesc($time).','.sqlesc($low_ratio).')')) {
            stderr($lang['classpromo_success'], $lang['classpromo_success_saved']);
        } else {
            stderr($lang['classpromo_error'], $lang['classpromo_err_query2']);
        }
        exit;
    }

    // remove
    if ('remove' == $mode) {
        $name = isset($_POST['remove']) ? htmlsafechars($_POST['remove']) : stderr($lang['classpromo_error'], $lang['classpromo_err_required']);
        if (sql_query('DELETE FROM class_promo WHERE name = '.sqlesc($name).'')) {
            stderr($lang['classpromo_success'], $lang['classpromo_success_reset']);
        } else {
            stderr($lang['classpromo_error'], $lang['classpromo_err_query']);
        }
        exit;
    }
}

//USER OUTPUT
$HTMLOUT .= "<h3>{$lang['classpromo_user_sett']}</h3>
<form name='edit' action='staffpanel.php?tool=class_promo&amp;mode=edit' method='post'>
<table width='100%' ><tr>
<td>{$lang['classpromo_clsname']}</td>
<td>&#160;</td>
<td>{$lang['classpromo_minratio']}</td>
<td>{$lang['classpromo_minupl']}</td>
<td>{$lang['classpromo_mintime']}</td>
<td>{$lang['classpromo_lowratio']}</td>
<td>{$lang['classpromo_remove']}</td>
</tr>";
$res = sql_query('SELECT * FROM class_promo ORDER BY id  ASC');
while ($arr = mysqli_fetch_assoc($res)) {
    $HTMLOUT .= "
<tr>

<td class='table'><input type='text' name='".htmlsafechars($arr['name'])."[]' size='25' value='".get_user_class_name(htmlsafechars($arr['name']))." ' readonly='readonly'/> (".htmlsafechars($arr['name']).")</td>
<td class='table'>&#160;<input type='hidden' name='".htmlsafechars($arr['name'])."[]' size='8' value='".htmlsafechars($arr['id'])."' /></td>
<td class='table'><input type='text' name='".htmlsafechars($arr['name'])."[]' size='8' value='".htmlsafechars($arr['min_ratio'])."'  /></td>
<td class='table'><input type='text' name='".htmlsafechars($arr['name'])."[]' size='8' value='".htmlsafechars($arr['uploaded'])."' /></td>
<td class='table'><input type='text' name='".htmlsafechars($arr['name'])."[]' size='8' value='".htmlsafechars($arr['time'])."'  /></td>
<td class='table'><input type='text' name='".htmlsafechars($arr['name'])."[]' size='8' value='".htmlsafechars($arr['low_ratio'])."'  /></td>

<td class='table'>
<form name='remove' action='staffpanel.php?tool=class_promo&amp;mode=remove' method='post'><input type='hidden' name='remove' value='".htmlsafechars($arr['name'])."' /><input type='submit' value='{$lang['classpromo_remove']}' /></form></td>
</tr>";
}
//$HTMLOUT.= "<br><br> ";

$HTMLOUT .= "<tr><td colspan='7' class='table'><input type='submit' value='{$lang['classpromo_apply']}' /></td></tr></table></form>";

$HTMLOUT .= "<div class='usage'>
{$lang['classpromo_info_minratio']}<br>
{$lang['classpromo_info_minupl']}<br>

{$lang['classpromo_info_mintime']}<br>

{$lang['classpromo_info_lowratio']}<br>

</div>";

$HTMLOUT .= "<h3>{$lang['classpromo_add_new_rule']}</h3>
<form name='add' action='staffpanel.php?tool=class_promo&amp;mode=add' method='post'>
<table width='100%' ><tr>
<th>{$lang['classpromo_clsname']}</th>
<th>{$lang['classpromo_minratio']}</th>
<th>{$lang['classpromo_minupl']}</th>
<th>{$lang['classpromo_mintime']}</th>
<th>{$lang['classpromo_lowratio']}</th>
</tr>
<tr>";
$HTMLOUT .= "<td><select name='name'>";
$maxclass = UC_STAFF;
for ($i = 1; $i < $maxclass; ++$i) {
    $HTMLOUT .= "<option value='$i'>".get_user_class_name($i)."</option>\n";
}
$HTMLOUT .= "</select></td>

                <td><input type='text' name='min_ratio' size='20' value=''  /></td>
                <td><input type='text' name='uploaded' size='20' value=''  /></td>
                <td><input type='text' name='time' size='20' value='' /></td>
                <td><input type='text' name='low_ratio' size='20' value=''  /></td>
                </tr>
<tr><td colspan='5' class='table'><input type='submit' value='{$lang['classpromo_add_new']}' /></td></tr>
</table></form>";
echo stdhead($lang['classpromo_stdhead']).$HTMLOUT.stdfoot();
