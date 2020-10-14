
<?php
session_start();
date_default_timezone_set('Europe/Istanbul'); //Time Zone

function alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg');</script>"; //JS Alerts
}
    $servername = "test";
    $username = "test";
    $password = "test";
    $dbname = "test";

    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8");

     $TempKisiID = $_POST['state'];


    $target_dir ="../../users/".$TempKisiID."/received/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $TempFileName = $_POST['FileName']; //POST the file with POST method in the HTML 

    if(isset($TempFileName) && $TempFileName != "" && $TempFileName!=" ")
    {
        $target_file = $target_dir . $TempFileName.".".$imageFileType;
        $TempFileName = $TempFileName.".".$imageFileType;
    }
    else
    {
        unset($TempFileName);
        $TempFileName = basename( $_FILES["fileToUpload"]["name"]);
    }


    if($imageFileType != "doc" && $imageFileType != "pdf" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "bmp"&& $imageFileType != "jpg" && $imageFileType != "tif" && $imageFileType != "xls" && $imageFileType != "xlsx" )
    {
       alert("That file you are trying to upload cant be accepted. Please use jpeg,png,bmp,jpg,tif,xls,xlsx,doc,pdf formats.");
       header("refresh:0;url=index.php");
    }
    else if (file_exists($target_file))
    {
      alert("That file you are trying to upload is already exist in the current folder.");
      header("refresh:10;url=index.php");
    }
    else if ($_FILES["fileToUpload"]["size"] > 50000000)
    {
      alert("File size is too large");
      header("refresh:10;url=index.php");
    }
    else
    {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
      {

        if ($conn->connect_error)
        {
          die("Bağlantı kurulamadı: " . $conn->connect_error);
        }

        $TempUserID = $_SESSION['UserID'];
        $UploadDate = date("d-m-Y  h:i ");
        $sorgu="INSERT INTO SentFiles (FileID,FileName, SenderID, ReceiveID, SendDate) VALUES (NULL, '$DosyaAdi',$TempUserID,'$TempKisiID','$UploadDate')";
        $ekle=$conn->prepare($sorgu);
        $ekle->execute();
        $conn->close();
        $ekle->close();

		//Give alert.
        alert("". $TempFileName." file has been sent to ".$TempKisiAD."");
		
		//Redirect index.php
        header("refresh:1;url=index.php");
		
		//Unset the variables after upload.
		
        unset($TempUserID);
      }
      else
      {
        alert("Error in uploading.");
      }
    }
