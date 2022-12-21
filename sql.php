<?php

$conn = null;

function Query($sql)
{
    global $conn;   
 
        $servername = "localhost";
        $database = "spam_server";
        $username = "root";
        $password = "";
        $conn = mysqli_connect($servername, $username, $password, $database)  or die(mysql_error());
        $rs = mysqli_query($conn,$sql);
        mysqli_close($conn);
    return($rs);

}
function multi_query($sql)
{
    global $conn;   

        $servername = "localhost";
        $database = "spam_server";
        $username = "root";
        $password = "";
        $conn = mysqli_connect($servername, $username, $password, $database)  or die(mysql_error());;
        $rs = mysqli_multi_query($conn,$sql);
        mysqli_close($conn);

        return($rs);

}

?>