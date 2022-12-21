<?php
error_reporting(0);
ini_set('display_errors', 0);

include 'sql.php';

// print_r($_POST);

function get_cmd($username, $name_machine) // load command cho từng tài khoản

{
    $i = 0;
    $tmp = 0;
    $arr[] = array();
    $acc_[] = array();
    $sql2 = "";
    // echo $username;
    if ($username) { //  chạy lệnh cho tài khoản lần đầu chạy trong ngày

        $sql = "SELECT * FROM `command` INNER join account WHERE command.group_acc = account.group_acc and account.username='$username' and account.checkpoint=0";
        // echo $sql;
        $rs1 = (Query($sql));
        // var_dump(mysqli_fetch_assoc (Query($sql)));

        while ($row = mysqli_fetch_assoc($rs1)) {
            if ($row['command'] == "follow_newfeed") {

                $total = 1;
            } else {
                // $total = rand(5, ($row['amount_once_day'] / 4)); // chỉnh lại random
                $total = ($row['amount_once_day'] / 2); // chỉnh lại random

            }
            $arr[$i] = [["username" => $row['username'], "amount_once_day" => $total, "url_link" => $row['url_link'], "command" => $row['command'], "time_delay" => $row['time_delay']]];
            $sql2 .= "INSERT INTO `run_log`( `account_run_log`, `command_id`, `amount_split`, `time_run`) VALUES ('" . $row['username'] . "','" . $row['command_id'] . "','$total',now());";
            $i++;
        }
        //     echo "</br>";
        //    echo $sql2;
        multi_query($sql2);

    } else { //
        $sql = "SELECT r.id_run_log,r.account_run_log,command_id, sum(amount_split)as total from run_log r WHERE DATE(r.time_run) = CURRENT_DATE() GROUP by account_run_log";
        // kiểm tra aaccount ngày đã chạy được bao nhiêu lệnh follow rồi
        $rs1 = (Query($sql));
        $row = mysqli_fetch_all($rs1, MYSQLI_ASSOC);
        foreach ($row as $key => $v) {
            // echo $v['total'];
            // echo "</br>";
            if ($v['total'] < 50) {
                $total = 0;
                $sql = "SELECT * FROM `command` INNER join account WHERE command.group_acc = account.group_acc and account.username='" . $v['account_run_log'] . "' and account.done=0 and account.checkpoint=0";
                $rs1 = (Query($sql));
                while ($row = mysqli_fetch_assoc($rs1)) {
                    if ($row['command'] == 'follow_newfeed') {
                        $total = 1;
                    } else {
                        $total = rand(10, ($row['amount_once_day'] / 2));
                    }
                    if ($v['total'] + $total < 50) {
                        $arr[$i] = [["username" => $row['username'], "amount_once_day" => $total, "url_link" => $row['url_link'], "command" => $row['command'], "time_delay" => $row['time_delay']]];
                        $sql2 .= "INSERT INTO `run_log`( `account_run_log`, `command_id`, `amount_split`, `time_run`) VALUES ('" . $row['username'] . "','" . $row['command_id'] . "','$total',now());";
                        // $sql2 .= "UPDATE `account` SET `running`=1 WHERE `username`='".$row['username']."';";

                        $i++;
                    }

                }
                // echo $sql2;
                multi_query($sql2);

            } else {
                // echo 'else';
                $sql2 = "UPDATE `account` SET `done`=1 WHERE `username`='" . $v['account_run_log'] . "';";
                Query($sql2);
            }

        }
        /*  while (){
    var_dump($row);
    $total = $row[''];
    echo $total."====".$row['account_run_log']."</br>";
    if ($total < 390){
    $sql = "SELECT * FROM `command` INNER join account WHERE command.group_acc = account.group_acc and account.username='".$row['account_run_log']."' and account.done=0 and account.checkpoint=0";
    $rs1 = (Query($sql));
    while ($row = mysqli_fetch_assoc($rs1))
    {
    $total = rand(10, ($row['amount_once_day'] / 4));
    $arr[$i] = [["username" => $row['username'], "amount_once_day" => $total, "url_link" => $row['url_link'], "command" => $row['command'], "time_delay" => $row['time_delay'], ], ];
    // $sql2 = "INSERT INTO `run_log`( `account_run_log`, `command_id`, `amount_split`, `time_run`) VALUES ('" . $row['username'] . "','" . $row['command_id'] . "','$total',now())";
    // Query($sql2);
    $i++;
    }
    }
    else{
    $sql2 = "UPDATE `account` SET `done`=1 WHERE `username`='".$row['account_run_log']."'";
    Query($sql2);
    }
    }*/
    }
    echo json_encode($arr);

}

// function get_cmd($username, $exculde_value)  // đã login tài khoản và lấy command
// {
//     // số lần thực hiện trong ngày sẽ được chia ra làm 3.
//     // mỗi lượt sẽ chạy 1/3 sau đó sẽ dừng, chuyển qua nick khác.
//     if ($exculde_value == null)
//     {
//         $sql = "SELECT * FROM `command` INNER join account WHERE command.group_acc = account.group_acc and account.username='$username'";
//         //$sql .= " limit 1";
//     }
//     else
//     {
//         $sql = "SELECT * FROM `command` INNER join account WHERE command.group_acc = account.group_acc ";
//         $SQL.= " and account.username='$username' and command.command_id not in ('$exculde_value')";
//     }
//     echo $sql." ".$exculde_value. "</br>";
//     $query = mysqli_fetch_array(Query($sql));
//     var_dump($query);
//     if ($query != null)
//     {
//         $sql1= "SELECT *,SUM(amount_split) as tong_chay FROM `run_log` where `account_run_log`='".$query['username']."' and `command_id`='".$query['command_id']."' and DATE(time_run) = CURDATE()";
//         $query1 = mysqli_fetch_array(Query($sql1));
//         if ($query1 == null)
//         {
//             $amount = rand(30,$query['amount_once_day']);
//         }
//         else
//         {
//             $amount = $query['amount_once_day'] - $query1['amount_split'];
//         }
//      $arr = [
//          [
//              "username" =>$query['username'],
//              "amount_once_day" => $amount,
//              "url_link" => $query['url_link'],
//              "command" =>$query['command'],
//              "time_delay" =>$query['time_delay'],
//          ],
//      ];
//      if($query1['tong_chay'] >= $query['amount_once_day']) // kiểm tra chạy đủ lệnh chưa, nếu đủ thì qua lệnh khác
//      {
//          if ($exculde_value == null)
//          {
//             get_cmd($username,$query['id']);
//          }
//      }
//      else
//      {
//         $sql2= "INSERT INTO `run_log`( `account_run_log`, `command_id`, `amount_split`, `time_run`) VALUES ('$username','".$query['id']."','$amount',now())";
//         Query($sql2);
//         echo json_encode($arr);
//      }
//     }
//     else
//     {
//         echo 'Error: '+$sql;
//     }
// }

function up_link_stt($link, $likes, $username)
{
    $sql2 = "INSERT INTO `link_stored`( `link_stored`, `like_number`, `account_get`) VALUES ('$link','$likes','$username')";
    Query($sql2);
}
function create_json()
{
}
function login_account($name_machine) // login tài khoản mới vào

{
    $sql = "SELECT * FROM `account` WHERE `checkpoint`=0 and `name_machine`='$name_machine' order by rand() limit 1";
    $query = mysqli_fetch_array(Query($sql));

    if ($query != null) {
        // print("login"."|".$query['username']."|".$query['pass']);
        $arr = [["username" => $query['username'], "password" => $query['pass'], "command" => 'login'],

        ];

        echo json_encode($arr);
    } else {
        echo 'Error: Het tai khoan dang nhap';
    }
}
function load_account($name_machine) // kiểm tra các tài khoản đã đăng nhập trên machine chưa

{

    if (@mysqli_num_rows($query) == 0) {
        login_account($name_machine);
    } else {
        $query = mysqli_fetch_array(Query($sql));
        //get_cmd($query['username']);

    }

}
function login_success($email, $name_machine) //cập nhật trạng thái của account tw

{
    echo $sql = "UPDATE `account` SET `logined`=1,`name_machine`='$name_machine' WHERE `username`='$email'";
    Query($sql);
}
function load_machine($username)
{
    echo $sql = "SELECT * FROM `manager_machine` where 'username'='$username'";
    Query($sql);
    $query = mysqli_fetch_array($rs);
    var_dump($query);

}

if ($_GET['function'] == "run" && $_GET['name_machine'] || $_GET['exclude']) {
    $name_machine = $_GET['name_machine'];
    $username_running = $_GET['exclude'];
    if (!empty($username_running)) {
        $sql = "SELECT * from account a WHERE not EXISTS (select account_run_log from run_log r WHERE DATE(r.time_run) = CURRENT_DATE()";
        $sql .= " and a.username = r.account_run_log and type NOT IN ('$username_running') ) and a.checkpoint=0 and a.name_machine ='" . $_GET['name_machine'] . "'   ORDER BY RAND() limit 1";

    } else {
        $sql = "SELECT * from account a WHERE not EXISTS (select account_run_log from run_log r WHERE DATE(r.time_run) = CURRENT_DATE()";
        $sql .= " and a.username = r.account_run_log) and a.checkpoint=0 and a.name_machine ='" . $_GET['name_machine'] . "' ORDER BY RAND() limit 1";

    }
    // kiểm tra tất cả các tài khoản đã chạy trong ngày hôm qua chưa chạy trong ngày hôm nay
    $rs = Query($sql);
    $query = mysqli_fetch_array($rs);
    $username = $query['username'];
    if ($username == null) {
        // tất cả tài khoản nào đã chạy  ngày hom nay thì sẽ lấy 1 tài khoản bất kỳ
        $sql = "select * from account where (date(done)is null or date(done) <date(now())) and checkpoint=0 and name_machine='$name_machine' ORDER by rand() limit 1";
        $query = Query($sql);
        $query = mysqli_fetch_array(Query($sql));
        $username = $query['username'];
    } else {
    }
    // else
    // {
    //    echo '[[{"command":"stop"}]]';
    // }

    get_cmd($username, $name_machine);

}
if (@$_GET['name_machine'] && $_GET['function'] == "login") {
    login_account($_GET['name_machine']);
}
if (isset($_GET['function']) == "load_machine" && isset($_GET['username_id'])) {
    load_machine($_GET['username_id']);
}
if (@$_POST['function'] == "locking" && isset($_POST['username'])) { //lock ussername
    // $sql2 = "UPDATE `account` SET `running`=1 WHERE `username`='".$_POST['username']."';";
    // Query($sql2);
}
if (@$_POST['function'] == "unlock" && isset($_POST['username'])) { //unlock ussername
    // $sql2 = "UPDATE `account` SET `running`=0 WHERE `username`='".$_POST['username']."';";
    // Query($sql2);
}
if (@$_POST['loggined'] && @$_POST['email'] && $_POST['name_machine']) {
    // echo $_POST['loggined'] ."===". $_POST['email'] ."===". $_POST['name_machine'];
    login_success($_POST['email'], $_POST['name_machine']);
}
if (@$_POST['link_stt'] && $_POST['likes'] && $_POST['username']) {

    up_link_stt($_POST['link_stt'], $_POST['likes'], $_POST['username']);
}
if ($_POST['function'] == "follow_done" && $_POST['username']) {
    echo $sql2 = "INSERT INTO run_log(account_run_log, command_id, amount_split) VALUES('" . $_POST['username'] . "', (select command_id from command where group_acc = (select group_acc from account WHERE username = '" . $_POST['username'] . "') and command = 'follow' limit 1),400)";
    Query($sql2);

}
if ($_POST['function']== "get_username_account" && $_POST['username']){
    $sql = "select * from log_follow_acc where username='".$_POST['username']."'";
    $check = mysqli_fetch_array(Query($sql));
    if ($check) {
        echo $check['username_login'];
    }
}
if ($_POST['function'] == "load_link_store" && $_POST['username']) {
    // echo "https://twitter.com/CamGirlsOnline_/status/1422240023655723009";
    $sql = "select * from link_stored where account_get=" . $_POST['username'] . " and used=0 limit 1";
    $query = mysqli_fetch_array(Query($sql));
    $username = $query['link_stored'];

    if ($username == null || $username == '') {
        $sql = "select * from link_stored where used=0 limit 1";
        $query = mysqli_fetch_array(Query($sql));
        $username = $query['link_stored'];
    }
    echo $username;
    $sql = "UPDATE `link_stored` SET `used` = '1' WHERE `link_stored`.`link_stored_id` = " . $query['link_stored_id'];
    $query = Query($sql);
}
if ($_POST['function'] == "update_follow_info") {
    echo $sql = "INSERT INTO `log_follow_acc`( `username`, `username_login`, `number_following`, `number_follower`, `date_check`) VALUES ('" . $_POST['username'] . "','" . $_POST['username_login'] . "'," . $_POST['number_following'] . "," . $_POST['number_followers'] . ",now())";
    $query = Query($sql);
}
if ($_POST['function'] == "stop") {
    echo $sql = "UPDATE `account` SET `done` = now() WHERE `username` =" . $_POST['username'];
    $query = Query($sql);
}
if (@$_POST['checkpoint'] && $_POST['username']) {
    $username = $_POST['username'];
    $checkpoint = $_POST['checkpoint'];
    echo $sql = "UPDATE `account` SET `checkpoint`=$checkpoint  WHERE `username`='$username'";
    Query($sql);
}
if ($_POST["api_key"]) {
    // echo $_GET['api_key'];
    $sql = "SELECT * FROM `username` WHERE `api_key`='" . $_POST['api_key'] . "'";
    // $query = Query($sql);
    $check = mysqli_fetch_array(Query($sql));
    if ($check) {
        echo $check['user_id'];
    }
}
if (@$_GET['function'] == "relogin") {
    $username = $_GET['username'];
    $sql = "SELECT * FROM `account` where username ='$username'";
    $query = Query($sql);
    $query = mysqli_fetch_array(Query($sql));
    echo $query['pass'];
}
function checkpoint($username)
{
    $sql = "UPDATE `account` SET `checkpoint`=1  WHERE `username`='$username'";
    Query($sql);
}
