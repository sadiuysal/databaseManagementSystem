<html>
    <head>
        <title></title>
    </head>
    <body>

        <?php
	    session_start();
   	    $_SESSION['oprNumber'] = "0";
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
		<p>Author's Name: <input type="text" name="a_name" /></p>
		<p>Author's Surname: <input type="text" name="a_surname" /></p>
		<p><input type="submit" value = "Go"/></p>
        	</form>
		<?php
                
            }
            $conn->close();
        ?>

    </body>
</html>
