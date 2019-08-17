<html>
    <head>
        <title></title>
    </head>
    <body>
        Hey you're logged in as <?php echo $_GET['userType']; ?>.
	<?php
	session_start();
	$_SESSION['userType'] = $_GET['userType'];	
	?>
		<form action="admin.php" method="get">
         	<p><input type="submit" value = "Next"/></p>
        	</form>		
    </body>
</html>
