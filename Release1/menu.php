<?php	
	if(!isset($_SESSION))
	{
		session_start();
	}
		echo '<ul>';
		echo '<li><a href="home.php" class="current"> Home </a> </li>';
		echo '<li><a href="contactus.html" class="current"> Contact us </a> </li>';
		
		
		if (isset($_SESSION['FirstName']) && isset($_SESSION['t_id']))
		{
			echo  '<li><a href="tenant_profile.php" class="current"> Profile </a> </li>';
			echo  '<li><a href="signout.php" class="current"> Sign Out </a> </li>';

		}
		else
		{
			echo  '<li><a href="signin.php" class="current"> Sign In </a> </li>';
		}
		
	echo '</ul>';
	
?>