<?php

    $servername = "localhost";
    $database = "spam_server";
    $username = "root";
    $password = "";
    $conn = mysqli_connect($servername, $username, $password, $database);

function Query($sql)
{
    global $conn;   
    if (!$conn) // will only connect if connection does not exist yet
    {
        $servername = "localhost";
        $database = "spam_server";
        $username = "root";
        $password = "";
        $conn = mysqli_connect($servername, $username, $password, $database);
    }
    return(mysqli_query($conn,$sql));
}
function multi_query($sql)
{
    global $conn;   
    if (!$conn) // will only connect if connection does not exist yet
    {
        $servername = "localhost";
        $database = "spam_server";
        $username = "root";
        $password = "";
        $conn = mysqli_connect($servername, $username, $password, $database);
    }
    return(mysqli_multi_query($conn,$sql));
}

?>