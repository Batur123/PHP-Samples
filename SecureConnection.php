<?php

session_start();


	function Control()
    {

		if(!(isset($_SESSION["IsLogin"]) && $_SESSION["IsLogin"] == "Yes"))
		{
			$_SESSION['RedirectErrorMessage']="You cant see this page without loginning to system.";

			header("Location: https://".$_SERVER['HTTP_HOST'].'/sayfa/index.php');
			exit;
		}
	   
    }
	
	function LoginControl()
	{
		if($_SESSION['IsLogin'] == "Yes")
		{
			header("Location: home.php");
			exit;
		}

			

		
	}
?>