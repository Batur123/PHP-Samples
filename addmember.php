
<?php
session_start();
date_default_timezone_set('Europe/Istanbul');
require_once('../baglanti.php');
$conn = BaglantiAc();


	
	$TempAd = $_POST['DosyaAdi'];
	$TempAd = mysqli_real_escape_string($conn,trim($TempAd);
	$TempDepartment = mysqli_real_escape_string($conn,$_POST['GonderenKisi']);
	$TempRole = mysqli_real_escape_string($conn,$_POST['GonderilmeTarih']);
	
	$TelNo = mysqli_real_escape_string($conn,$_POST['TelNo']);
	$MailAdres = mysqli_real_escape_string($conn,$_POST['MailAdres']);
	$AracMarkasi = mysqli_real_escape_string($conn,$_POST['AracMarkasi']);
	$PlakaNo = mysqli_real_escape_string($conn,$_POST['PlakaNo']);
	$Adres = mysqli_real_escape_string($conn,$_POST['Adres']);
	$SimKartNo = mysqli_real_escape_string($conn,$_POST['SimKartNo']);
	$BirimGunluk = mysqli_real_escape_string($conn,$_POST['BirimGunluk']);
	$IseGirisTarihi = mysqli_real_escape_string($conn,$_POST['IseGirisTarihi']);
	$DogumTarihi = mysqli_real_escape_string($conn,$_POST['DogumTarihi']);
	$SigortaNo = mysqli_real_escape_string($conn,$_POST['SigortaNo']);
	$EhliyetNo = mysqli_real_escape_string($conn,$_POST['EhliyetNo']);
	$PasaportNo = mysqli_real_escape_string($conn,$_POST['PasaportNo']);
	
	
	if(is_numeric($BirimGunluk) == 0)
	{
		alert("Tagesgehalt is null.");
		header("refresh:1;url=index.php");
	}
	else
	{
		$sorgu="INSERT INTO personel(id, AdSoyad, Departman, Rol, Resim, TelNo, AracMarkasi, PlakaNo, Adresi, SimKartNo, BirimGunluk, IseGirisTarihi, MailAdres, DogumTarihi, SigortaNO, EhliyetNo, PasaportNo) VALUES (NULL, '$TempAd','$TempDepartment','$TempRole','Test.png','$TelNo','$AracMarkasi','$PlakaNo','$Adres','$SimKartNo','$BirimGunluk','$IseGirisTarihi','$MailAdres','$DogumTarihi','$SigortaNo','$EhliyetNo','$PasaportNo')";
        $ekle=$conn->prepare($sorgu);
        $ekle->execute();
		$TempUserID = mysqli_insert_id($conn);
		
		$sorgu2 = "CALL KisiTabloOlustur(".$TempUserID.",'".$TempAd."')";

		$stmt = $conn->prepare($sorgu2);
		$stmt->execute();


					$directoryName = "../users/".$TempUserID;
					$ProfilResmi = "../users/".$TempUserID."/profilephoto";


					
					
					if(!is_dir($directoryName))
					{
						mkdir($directoryName, 0755);
					}
					if(!is_dir($ProfilResmi))
					{
						mkdir($ProfilResmi, 0755);
					}
					
					
					if(!empty($_FILES["fileToUpload"]["name"]))
					{
						
						$target_dir ="../users/".$TempUserID."/profilephoto/";
						$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
						$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

						$sql = "UPDATE personel SET Resim='$target_file' WHERE id='$TempUserID'";

						if (mysqli_query($conn, $sql)){}	
						if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "bmp"&& $imageFileType != "tif")
						{
						   alert("This image/file cannot be accepted. Please upload only jpeg,png,bmp,jpg,tif extensions.");
						   header("refresh:0;url=index.php");
						}									
						else if ($_FILES["fileToUpload"]["size"] > 50000000)
						{
						  alert("Image size is too big. Try again.");
						  header("refresh:0;url=index.php");
						}
						else
						{
							
							$handle = opendir($target_dir);
									$c = 0;
									while ($file = readdir($handle)&& $c<3)
									{
										$c++;
									}
									
								if ($c>2)
								{
									$files = glob($target_dir.'*');  
									foreach($files as $file)
									{ 
									  if(is_file($file))
									  {
										  unlink($file);  
									  }							
									} 		
									goto git;
								} 
								else 
								{
									git:
									
									if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "bmp"&& $imageFileType != "tif")
									{
									   alert("This image/file cannot be accepted. Please upload only jpeg,png,bmp,jpg,tif extensions.");
									   header("refresh:0;url=index.php");
									}
									else if ($_FILES["fileToUpload"]["size"] > 5000000)
									{
									   alert("Image size is too big. Try again.");
									  header("refresh:10;url=index.php");
									}
									else
									{
										if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
										{
											
										}
										else
										{
											alert("Yüklemede hata oluştu.");
											goto hata;
										}
									}
								} 
						}				
					}
					
		$conn->close();
		$ekle->close();
		alert("Kullanıcı oluşturuldu.");
		hata:
		header("refresh:1;url=index.php");
	


					
					
				
	}


