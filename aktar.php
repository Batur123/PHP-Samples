<?php

        session_start();
		
		
		//Veritabanı bağlantısı
		require_once('../../baglanti.php');
		$mysqli=BaglantiAc();

        $RaporID =$_GET["id"];
		$TempKisiID = $_SESSION['KullaniciID'];

        if(isset($RaporID))
        {
			$query= "SELECT GonderilenRaporlar.RaporID,GonderilenRaporlar.RaporAD,users.u_name,GonderilenRaporlar.GonderimTarihi,users.Bolum_ID
					FROM GonderilenRaporlar 
					INNER JOIN users ON GonderilenRaporlar.GonderenKisiID = users.id
					WHERE  RaporID = '$RaporID'";
					
					
			
					
          //  $query = "SELECT * FROM GonderilenRaporlar WHERE RaporID = '$RaporID'";
            $data = mysqli_query($mysqli,$query);

            if($data)
            {
                    if (mysqli_num_rows($data) > 0)
                    {
                        while($row = mysqli_fetch_assoc($data))
                        {
                            $_SESSION['Rapor_BelgeNO'] = $row['RaporID'];
                            $_SESSION['Rapor_AD'] = $row['RaporAD'];
                            $TempKisininAdi = $row['u_name'];
							$TempBolumID = $row['Bolum_ID'];
                            $_SESSION['Rapor_EklenmeTarihi']= $row['GonderimTarihi'];
                        }
							
						//Gonderen kisinin ID'sini alip ait oldugu Bolumun ADI
						$query2 = "SELECT * FROM Bolumler WHERE Bolum_ID = '$TempBolumID'";
						$data2 = mysqli_query($mysqli,$query2);
						
						if($data2)
						{
							if(mysqli_num_rows($data2) > 0)
							{
								while($row2 = mysqli_fetch_assoc($data2))
								{
									$TempBolumAD = $row2['Bolum_AD'];
								}

								$_SESSION['Rapor_KisiAD'] = $TempKisininAdi." / ".$TempBolumAD;
								
							}
							else
							{
								echo "Veritabanı hatası oluştu. 3";
							}
						}
						else
						{
							echo "Veritabanı hatası oluştu. 4";
						}					
						//Gonderen kisinin ID'sini alip ait oldugu Bolumun ADI

                        //İşlem bitince işlemci Kullanımını azaltıp değişkenleri derleyiciden kaldırma
						unset($TempBolumAD);
						unset($TempKisininAdi);
						unset($TempBolumID);
                        unset($servername);
                        unset($username);
                        unset($password);
                        unset($dbname);
                        //İşlem bitince işlemci Kullanımını azaltıp değişkenleri derleyiciden kaldırma

                        $_SESSION['OnizlemeDosya'] = "../kisiler/".$TempKisiID."/alinan/".$_SESSION['Rapor_AD'];
                        header("Refresh: 0; index.php");
                    }
                    else
                    {
                        echo "Veritabanı hatası oluştu.";
                    }
            }
            else
            {
                echo "Veritabanı hatası oluştu. (2)";
            }


        }
        else
        {
            echo "ID alınamadı.";
        }



mysqli_close($mysqli);













?>