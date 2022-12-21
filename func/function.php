<?php
include ('sql.php');
function ajax_create_group_acc($dt)
{
    $links = (json_decode($dt['links']));
    // $tags = (json_decode($dt['tags']));
    $likes_profile = (json_decode($dt['likes_profile']));
    $links_retweet = (json_decode($dt['links_retweet']));
    $following = (json_decode($dt['following']));
    // $delay_time = $dt['delay_time'];
    $num_follow = $dt['num_follow'];
    $num_unfollow = $dt['num_unfollow'];
    $num_retweet = $dt['num_retweet'];
    $num_likes_profile = $dt['num_likes_profile'];
    $name_profile="";
    $sql ="";
    if(isset($dt['name_group_profile'])){
        $name_profile =$dt['name_group_profile'];
    }
    if(isset($num_unfollow) >0 && $num_unfollow != null || $num_unfollow != ''){ 
        $sql.= "INSERT INTO `detail_profile`( `name_profiles`, `command`, `run_once_day`) VALUES ('{$name_profile}','unfollow','{$num_unfollow}');";
    }
    if($links != null && count(($links))){
        foreach($links as $l){
            $sql.= "INSERT INTO `manager_link`( `name_profile`,`link`) VALUES ('{$name_profile}','{$l->value}');";
        }        
    }
    if(isset($num_likes_profile) && $likes_profile !=0){ // like stt của các acc trong nhóm 
        
    }

    if(isset($following) && ($num_follow != 0)){
        foreach($following as $l){
            $sql .= "INSERT INTO `detail_profile`( `name_profiles`, `command`, `value`,`run_once_day`) VALUES ('{$name_profile}','follow','{$l->value}',{$num_follow});";
        }
    }
    if(isset($links_retweet) && ($num_retweet != 0)){ // retweet stt của các acc trong nhóm 
        echo 'links_retweet';
        $value = (json_encode($dt['links_retweet']));
    }
    multi_query($sql);
    // foreach($dt as $k =>$v){
    //     if(!empty($v)){
           
    //         if($v= 'num_likes_profile' && ){

    //         }
    //         $value = array(json_decode($v));
    //         // var_dump($value);
    //         if(in_array("",$value)){
    //             echo $k. 'co mang';
    //         }
    //         // if(in_array("value",json_decode($v),true)){
    //         //     echo 'co mang';
    //         // }
            
    //     }
    // }
    // $sql = 'SELECT FLOOR(10 + RAND() * 9999) AS random_number FROM manager_profiles WHERE "manager_profiles" NOT IN (SELECT group_id FROM group_acc) LIMIT 1;'; // tạo giá trị không trùng trong group_acc
    // $kq = mysqli_fetch_array(Query($sql));
    // $group_id = $kq[0];
    // $sql = "INSERT INTO group_acc ( group_id, name_group, user_id ) VALUES (" . $group_id . ",'" . $dt['name_group'] . "'," . $dt['user_id'] . ");"; //
    // if ($links != null || $links != '')
    // {
    //     foreach (@$links as $v)
    //     {
    //         $sql .= "INSERT INTO `manager_link`( `link`, `group_id`) VALUES ('" . $v->value . "','" . $group_id . "');";
    //     }
    // }
    // if ($tags != null || $tags != '')
    // {
    //     foreach (@$tags as $v)
    //     {
    //         $sql .= "INSERT INTO `manager_tags`(`tags`, `group_user_id`)VALUES ('" . $v->value . "','" . $group_id . "');";
    //     }
    // }
    // if ($likes_profile != null || $likes_profile != '')
    // {
    //     foreach (@$likes_profile as $v)
    //     {
    //         $sql .= "INSERT INTO `command`(`command`, `group_acc`, `url_link`, `amount_once_day`, `time_delay`) VALUES ('likes','" . $group_id . "','" . $v->value . "','" . $num_likes_profile . "','" . $delay_time . "');";
    //     }
    // }
    // if ($links_retweet != null || $links_retweet != '')
    // {
    //     foreach (@$links_retweet as $v)
    //     {
    //         $sql .= "INSERT INTO `command`(`command`, `group_acc`, `url_link`, `amount_once_day`, `time_delay`) VALUES ('retweet','" . $group_id . "','" . $v->value . "','" . $num_retweet . "','" . $delay_time . "');";
    //     }
    // }
    // if ($following != null || $following != '')
    // {
    //     foreach (@$following as $v)
    //     {
    //         $sql .= "INSERT INTO `command`(`command`, `group_acc`, `url_link`, `amount_once_day`, `time_delay`) VALUES ('follow','" . $group_id . "','" . $v->value . "','" . $num_follow . "','" . $delay_time . "');";
    //     }
    // }

    // echo ($sql);
    // (multi_query($sql));

}
function show_group_profile($user)
{
    $sql = "select * FROM group_acc WHERE user_id='$user' ";
    return Query($sql);

}

function import_account($dt)
{
    $sql = 'SELECT FLOOR(10 + RAND() * 9999) AS random_number FROM group_acc WHERE "group_acc" NOT IN (SELECT group_id FROM group_acc) LIMIT 1'; // tạo giá trị không trùng trong group_acc
    $kq = mysqli_fetch_array(Query($sql));
    // tạo id group không trùng
    $sql = "INSERT INTO group_acc ( group_id, name_group, user_id ) VALUES (" . $kq[0] . ",'" . $dt['name_group'] . "'," . $dt['user_id'] . ")"; //
    Query($sql);
    $sql = "INSERT INTO account ( username, pass, 2fa_code, group_acc,logined)";
    $sql .= 'VALUES ("' . $dt["username"] . '","' . $dt["pass"] . '","' . $dt["facode"] . '","' . $kq[0] . '","' . $dt['logined'] . '")';
    Query($sql);
}
/* REQUEST DATA GROUP */
function load_group_acc($user_id)
{
    $sql = "SELECT * from `group_acc` where `user_id`='$user_id'"; //
    $kq = (Query($sql));
    return $kq;
}
function update_account_group($dt)
{
    $sql = "INSERT INTO account ( username, pass, name_machine, 2fa_code, group_acc,logined)";
    $sql .= 'VALUES ("' . change_value_null($dt["username"]) . '","' . change_value_null($dt["pass"]) . '","' . change_value_null($dt["name_machine"]) . '","' . change_value_null($dt["facode"]) . '","' . $dt['group_id'] . '","' . $dt['logined'] . '")';
    Query($sql);
}
function change_value_null($dt)
{
	echo $dt;
	if ($dt == 'undefined')
	{
		return "";
	}else{
		return $dt;
	}
}
function load_all_account($user_id)
{
    $sql = "SELECT * FROM `account` INNER join group_acc
on account.group_acc = group_acc.group_id
where group_acc.user_id='$user_id'";
    $db_query = Query($sql);
    return $db_query;
}
function delete_account($account)
{
    echo $sql = "DELETE FROM `account` WHERE `account`.`id` = '$account'";
    Query($sql);
}
// MANAGER LINK
function load_manager_link()
{
    $sql = "INSERT INTO manager_link ( link,group_id)";
    $sql .= 'VALUES ("' . $dt["link"] . '","' . $dt["group_id"] . '")';
    Query($sql);
}
function load_links_group($user_id)
{
    $sql = "SELECT * from `manager_link` m inner join group_acc gr on m.group_id = gr.group_id where gr.user_id='$user_id' GROUP BY m.id";
    $kq = (Query($sql));
    return $kq;
}
function load_links_group_ajax($user_id)
{
    $acc = load_links_group(1);
    $arrayName = array();
    while ($dt = mysqli_fetch_object($acc))
    {
        $arrayName[] = array(
            "value" => $dt->link,
            "id" => $dt->id
        );
    }
    echo json_encode($arrayName);
}
function create_links($dt)
{
    $sql = "INSERT INTO manager_link ( link,group_id)";
    $sql .= 'VALUES ("' . $dt["link"] . '","' . $dt["group_id"] . '")';
    Query($sql);
}
function remove_link($dt)
{
    echo $sql = "delete from manager_link where id='" . $dt['link_id'] . "'";
    Query($sql);
}
function remove_profile($group_id)
{
    echo $sql = "DELETE FROM `group_acc` WHERE `group_acc`.`group_id` ='" . $group_id . "';";
    $sql.="DELETE FROM `manager_link` WHERE `manager_link`.`group_id` = '" . $group_id . "';";
    $sql.="DELETE FROM `manager_tags` WHERE `manager_tags`.`id`= '" . $group_id . "';";
    $sql.="DELETE FROM `command` WHERE `command`.`command_id` ='" . $group_id . "';";
    multi_query($sql);
}
// MANAGER TAGS
function load_manager_tags($user_id)
{
    echo $sql = "SELECT * from `manager_tags` m inner join group_acc gr on m.group_user_id = gr.group_id where gr.user_id='$user_id' GROUP BY m.id";
    $kq = (Query($sql));
    return $kq;
}
function load_manager_stt()
{
}
function load_()
{
}
if (isset($_POST['function']))
{
    switch ($_POST['function'])
    {
        case 'import_account':
            import_account($_POST);
        break;
        case 'update_account_group':
            update_account_group($_POST);
        break;
        case 'create_links':
            create_links($_POST);

        break;
        case 'remove_link':
            remove_link($_POST);
        break;

        break;
        case "remove_profile":
            remove_profile($_POST['group_id']);
        break;
        case 'remove_acc':
            delete_account($_POST['account_id']);
        break;

        case 'load_links_group':
            load_links_group($_POST['user_id']);
        break;

        case 'load_links_group_ajax':
            load_links_group_ajax($_POST['user_id']);
        break;

        case 'create_group_acc':
            ajax_create_group_acc($_POST);
        break;
        case 'load_command_group_profile':
            load_command_group_profile($_POST['group_id']);
        break;
        case 'load_spammer_link':
            load_spammer_link($_POST['group_id']);
        break;
        case 'load_tags':
            load_tags($_POST['group_id']);
        break;
        case 'load_likes':
            load_command_group_profile($_POST['group_id']);
        break;
        case "update_profile_group":
            ajax_update_data_command($_POST);
        break;
        case "remove_att":
        remove_att($_POST);
        break;
        default:
            # code...
            
        break;
    }
}
function remove_att($dt){
	switch ($dt['name_textrea']) {
		case 'load_likes':
		$sql ="delete from `command` where `command_id`='".$dt['att_id']."'";
			break;
		case "following_links":
				$sql ="delete  from `command` where `command_id`='".$dt['att_id']."'";

		break;
		case "spammer_links":
		$sql ="delete from `manager_link` where `id`='".$dt['att_id']."'";
		break;
		case 'load_tags':
		$sql ="delete from `manager_tags` where `id`='".$dt['att_id']."'";
		break;

	}
	echo $sql;
	Query($sql);
}
function load_likes($group_id)
{

}
function load_spammer_link($group_id)
{
    $sql = "SELECT * FROM `manager_link` WHERE group_id='$group_id'";
    $cmd = Query($sql);
    $link_spammer = array();
    while ($r = mysqli_fetch_array($cmd))
    {
        $link_spammer[] = array(
            "value" => $r['link'],
            "id" => $r['id']
        );
    }
    if (@$link_spammer != null)
    {
        echo json_encode($link_spammer, JSON_UNESCAPED_SLASHES, JSON_NUMERIC_CHECK);

    }
}
function ajax_update_data_command($dt)
{
    // var_dump($dt);
    $sql = "";
    $follow_links = json_decode($dt['data']);
    $links_like = "";
    $links_spam = "";
    $tags = "";

    foreach ($follow_links as $key => $value)
    {
        if (@$value->id)
        {
            switch ($value->cmd_func)
            {
                case 'following_links':
                    $sql .= "UPDATE `command` SET `url_link`='$value->value' where command_id='$value->id';";
                break;
                case "load_tags":
                    $sql .= "UPDATE `manager_tags` SET `tags`='$value->value' where `id`='$value->id';";
                break;
                case "load_likes":
                    $sql .= "UPDATE `command` SET `url_link`='$value->value' where `command_id`='$value->id';";
                break;
                case "spammer_links":
                    $sql .= "UPDATE `manager_link` SET `link`='$value->value' where `id`='$value->id';";
                break;
                default:
                    # code...
                    
                break;
            }

        }
        else
        {

            switch ($value->cmd_func)
            {
                case 'following_links':
                    $sql .= "INSERT INTO `command`(`command`, `group_acc`, `url_link`) VALUES ('follow','" . $value->group . "','" . $value->value . "');";
                case "load_tags":
                    $sql .= "INSERT INTO `manager_tags` (`tags`,`group_user_id`) VALUES ('$value->value','$value->group');";
                break;
                case "load_likes":

                    $sql .= "INSERT INTO `command`(`command`, `group_acc`, `url_link`) VALUES ('likes','" . $value->group . "','" . $value->value . "');";
                break;
                case "spammer_links":
                    $sql .= "INSERT INTO `manager_link` (`link`,`group_id`) VALUES ('$value->value','$value->group');";
                break;
                default:
                    # code...
                    
                break;
            }
        }
    }
    var_dump (multi_query($sql));
    
}
function load_command_group_profile($group_id)
{
    $sql = "SELECT * FROM `command`WHERE group_acc='$group_id' ORDER BY command ASC";

    $cmd = Query($sql);
    $follow_arr = array();
    $follow = array();
    $likes = array();
    if (mysqli_num_rows($cmd) != 0)
    {
        $i = 0;
        while ($r = mysqli_fetch_array($cmd))
        {

            switch ($r['command'])
            {
                    //  case 'follow':
                    // $follow_arr[] = array("value" => $r['url_link'], "id" => (int)$r['command_id']);
                    // break;
                    
                case "follow":
                    $follow[] = array(
                        "value" => $r['url_link'],
                        "id" => $r['command_id']
                    );

                break;

                case "likes":
                    $likes[] = array(
                        "value" => $r['url_link'],
                        "id" => $r['command_id']
                    );
                break;
                default:
                    # code...
                    
                break;

            }
            $follow_arr['follow'] = $follow;
            $follow_arr['likes'] = $likes;
        }
        if (@$follow_arr != null)
        {
            echo json_encode($follow_arr, JSON_UNESCAPED_SLASHES, JSON_FORCE_OBJECT);

        }
    }

}
function load_tags($group_id)
{
    $sql = "SELECT * from `manager_tags` m inner join group_acc gr on m.group_user_id = gr.group_id where gr.group_id='$group_id' GROUP BY m.id";

    $cmd = Query($sql);
    $follow_arr = array();
    while ($r = mysqli_fetch_array($cmd))
    {

        $follow_arr[] = array(
            "value" => $r['tags'],
            "id" => (int)$r['id']
        );

    }
    echo json_encode($follow_arr, JSON_UNESCAPED_SLASHES, JSON_NUMERIC_CHECK);
}
?>
