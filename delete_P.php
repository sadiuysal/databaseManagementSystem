<html>
    <head>
        <title></title>
    </head>
    <body>

        <?php
	    session_start();
   	    $_SESSION['oprNumber'] = "5";
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "DB_3";	    
	

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }else{
		?>
		<form action="sql.php" method="get">
		<p>Paper's Title to delete: <input type="text" name="p_title" /></p>
		<p><input type="submit" value = "Next"/></p>
        	</form>
		<?php
                
            }
            $conn->close();
        ?>

    </body>
</html>
