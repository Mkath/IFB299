<?php
include 'connection.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> Welcome to Rent property </title>
    <link href="main_11.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="main_javascript.js"></script>
</head>

<body>

<div id="outside">
	<div id="header">
		<br>
		<h1>Rental Service Company</h1>

			<div id="Menu">
				<?php include 'menu.php'; ?>
			</div> <!--Menu -->

	</div> <!--header -->


	<div id="secondBanner">

		<img src="images/house3.jpg" width="770" height="90" alt="welcome to Property Service"/>
	</div> <!---secondBanner -->


	<div id="bigContent">
			<div id="secondContent">
        <div id="sign-in">
          <h3>Sign In</h3><br>
          <form name="signin" onsubmit="return signinvalidate(signin)" action="signin.php" method="GET">
            <input type="text" name="username" onkeypress="invisible('usernameMissing')" placeholder="Enter Username">
            <br><span id="usernameMissing" style="color:red; visibility:hidden">*'Username' is a required field</span>
            <p>
            <input type="password"  name="password" onkeypress="invisible('passwordMissing')" placeholder="Enter Password">
            <br><span id="passwordMissing" style="color:red; visibility:hidden">*'Password' is a required field</span>
            <p>
            <input type="submit" value="Sign In"/>
            &nbsp; &nbsp;
            <input type="reset" value="Clear"/>
          </form><p>
          Don't Have an Account? <a href="tenant_registration.php">Sign Up</a>
          <?php


            //this function removes an unwanted characters from the suburb
            if (isset($_GET['username']) AND isset($_REQUEST['password'])){
              function validate($field)
              {
              $field = trim($field);
              $field = stripslashes($field);
              $field = htmlspecialchars($field);
              return $field;
              }

              //The following lines assign variables from the search form to local php variables
              $user_name = validate($_GET["username"]);
              $p_word = validate($_GET["password"]);

              $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
              $stmt = $conn->prepare('SELECT * FROM `tenant_details` WHERE `tenant_username` = :uname AND `tenant_password` = :pword');

              $stmt->bindParam(':uname', $user_name, PDO::PARAM_STR);
						  $stmt->bindParam(':pword', $p_word, PDO::PARAM_STR);
              $stmt->execute();
              $nCounter = 0;
              foreach($stmt as $row)
						  {
                if ($row['tenant_username'] == $user_name AND $row['tenant_password'] == $p_word){
                  echo '<script type="text/javascript">
                  alert("You have been successfully logged in");
                  </script>';
				session_start();
				$_SESSION['t_id'] = $row['tenantid'];
				$_SESSION['FirstName'] = $row['tenant_firstname'];


				if (isset($_GET['prev']))
				{
					$prev_page = $_GET['prev'];
				}
				else
				{
					$prev_page ="home.php";
				}

				header("location:  http://{$_SERVER['HTTP_HOST']}/$prev_page");
                //$nCounter = $nCounter+1;

                }

              }
              if ($nCounter == 0) {
                echo '<script type="text/javascript">';
                echo 'alert("Username or Password is incorrect!");';
                echo 'window.location.href = "signin.php";';
                echo '</script>';
                return false;

             }
            }
          ?>
        </div>


				<br>
				<br>
				<br>
				<br>


			</div>

				<div id="news">





					<p class="clear"></p>

				</div><!--news-->

	</div> <!---contentOne -->


</div> <!--outside -->

		<div id="footer">
			<p> &#169; Rental Service Company &nbsp; Group 93 IFB299 &nbsp;&nbsp;
				<a href="privacy.html"> Privacy Policy</a>
				<a href="term.html"> Terms and Conditions</a>
			</p>
		</div>

</body>
</html>
