<html>
    <head>
        <title></title>
    </head>
    <body>

        <?php
	    session_start();
   	    $_SESSION['oprNumber'] = "3";
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
		<form action="aInfo.php" method="get">
		<p>Paper's Title: <input type="text" name="p_title" /></p>
		<p>Paper's number of Authors: <input type="text" name="p_nofA" /></p>
		<p>Paper's Abstract: <input type="text" name="p_abstract" /></p>
		<p>Paper's number of Topics: <input type="text" name="p_nofT" /></p>
		<p>Paper's Result: <input type="text" name="p_result" /></p>
		<p><input type="submit" value = "Next"/></p>
        	</form>
		<?php
                
            }
            $conn->close();
        ?>

    </body>
</html>
