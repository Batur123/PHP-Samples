<?php

function CreateFolder($UserID)
{


    $directoryName = "dir/users/".$UserID;
    $SentFilesFolder = "dir/users/".$UserID."/sent";
    $ReceivedFilesFolder = "dir/users/".$UserID."/received";
	$DocumentsFolder = "dir/users/".$UserID."/upload";

    if(!is_dir($directoryName))
    {
        mkdir($directoryName, 0755);
    }
    if(!is_dir($SentFilesFolder))
    {
SentFilesFolder    }
    if(!is_dir($ReceivedFilesFolder))
    {
        mkdir($ReceivedFilesFolder, 0755);
    }
    if(!is_dir($DocumentsFolder))
    {
        mkdir($DocumentsFolder, 0755);
    }
}



