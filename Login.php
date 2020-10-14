<?php

        session_start();
        require_once('DBConnection.php');
        $mysqli = OpenConnection();

        $_SESSION['UserMail'] = $_POST['user'];
        $_SESSION['UserPass'] = $_POST['pass'];

		try
		{
            $user = $_SESSION['UserMail'];
            $pass = $_SESSION['UserPass'];

			if(isset($user) || isset($pass))
			{

				$query = "SELECT * FROM users WHERE u_email = '$user' AND u_pass = '$pass'";
				$data = mysqli_query($mysqli,$query);

				if($data)
				{
					if (mysqli_num_rows($data) == 1 )
					{
                        if (mysqli_num_rows($data) > 0)
                        {
                            while($row = mysqli_fetch_assoc($data)) {

                                $_SESSION['UserName'] = $row['u_name'];
                                $_SESSION['UserMail'] = $row['u_email'];
                                $_SESSION['UserAuthStatus'] = $row['status'];
                                $_SESSION['UserID'] = $row['id'];
                                $_SESSION['UserDepartmenID']= $row['DepartmentID'];
                            }
                            require_once('UserFolder.php');
							KisiKontrol($_SESSION['UserID']);
                        }
                        else
                        {
                            alert("Database connection has occured.");
                        }
						$_SESSION['IsLogged'] = "Yes";
							        $Yonlendirme = $_SERVER['DOCUMENT_ROOT']."/dir/index.php";
						$_SESSION['Test'] = $Yonlendirme;
                        CloseConnection($mysqli);
						header("refresh:0;url=home.php");
					}
					else
					{
						alert("Wrong name or password.");
						session_unset();
						header("refresh:1;url=index.php");
					}
				}
				else
				{
					alert("Database error");
					session_unset();
					header("refresh:1;url=index.php");
				}
			}
			else
			{
				alert("Do not leave empty the user or password fields.");
				session_unset();
				header("refresh:1;url=index.php");
			}
		}
		catch(Exception $ex)
		{
			alert("message -> ".$ex->getMessage());
			session_unset();
			header("refresh:1;url=index.php");
		}




