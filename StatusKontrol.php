    <?php

    session_start();

	function cut_string_using_last($character, $string, $side, $keep_character=true)
	{
		$offset = ($keep_character ? 1 : 0);
		$whole_length = strlen($string);
		$right_length = (strlen(strrchr($string, $character)) - 1);
		$left_length = ($whole_length - $right_length - 1);
		switch($side)
		{
			case 'left':
				$piece = substr($string, 0, ($left_length + $offset));
				break;
			case 'right':
				$start = (0 - ($right_length + $offset));
				$piece = substr($string, $start);
				break;
			default:
				$piece = false;
				break;
		}
		return($piece);
	}

    function StatusKontrolEt()
    {
        require_once('baglanti.php');
        $mysqli = BaglantiAc();
		

			global $pagenow;

            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $CurPageURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];		
            $pagenow = $CurPageURL;
			
			$TempStatusID = $_SESSION['KullaniciStatus'];

			$TempPageNow = $pagenow;
			
			$pagenow = cut_string_using_last('/', $pagenow, 'left', true);
			
			/*if(strpos($pagenow, "index.php") !== false)
			{
               // $pagenow = substr($pagenow, 0,-9);
				$TempAd = substr(strrchr($pagenow,'/'), 1);
				$pagenow = substr($pagenow, 0, - strlen($TempAd));
            }
			else if(strpos($pagenow, "goster.php") !== false)
			{
               // $pagenow = substr($pagenow, 0,-9);
				$TempAd = substr(strrchr($pagenow,'/'), 1);
				$pagenow = substr($pagenow, 0, - strlen($TempAd));
            }
			else if(strpos($pagenow, "sil.php") !== false)
			{
               // $pagenow = substr($pagenow, 0,-9);
				$TempAd = substr(strrchr($pagenow,'/'), 1);
				$pagenow = substr($pagenow, 0, - strlen($TempAd));
            }
			else if(strpos($pagenow, "name.php") !== false)
			{
               // $pagenow = substr($pagenow, 0,-9);
				$TempAd = substr(strrchr($pagenow,'/'), 1);
				$pagenow = substr($pagenow, 0, - strlen($TempAd));
            } */
			
			$_SESSION['Sayfa'] = $pagenow;
			$_SESSION['FullSayfa'] = $TempPageNow;
			$query = "SELECT * FROM Access WHERE AccessAuthCode LIKE '%$TempStatusID%'and AccessAuthNo LIKE '%$pagenow%'";
				$data = mysqli_query($mysqli,$query);
				if($data)
				{
                        if (mysqli_num_rows($data) > 0)
                        {
                            while($row = mysqli_fetch_assoc($data))
							{
                            }

                        }
                        else
                        {
                            exit(header("Location: forbid.php"));
							
                        }

				}
				else
				{
					exit(header("Location: forbid.php"));
				}
				
			echo "FullPageURL".$TempPageNow."\n";
			echo "SecurePage".$pagenow;

		BaglantiKapat($mysqli);
     
    }



    ?>