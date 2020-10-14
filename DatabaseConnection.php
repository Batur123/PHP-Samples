<?php



//Open MYSQL connection function.
function OpenConnection()
{

    $servername = "YourServername";
    $username = "YourUsername";
    $password = "YourPassword";
    $dbname = "DatabaseName";


    $mysqli = new mysqli($servername, $username, $password, $dbname);
    $mysqli->set_charset("utf8"); //UTF-8 Language support.

    if ($mysqli->connect_error)
    {
        alert("Database connection is failed.");
        exit;
    }

        return $mysqli;

}


//Function that can close the MYSQL connection.
function CloseConnection($mysqli)
{
$mysqli -> close();
}
