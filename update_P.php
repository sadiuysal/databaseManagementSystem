<html>
    <head>
        <title></title>
    </head>
    <body>

        <?php
	    session_start();
   	    $_SESSION['oprNumber'] = "4";
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
		<p>Paper's Title to change: <input type="text" name="p_title" /></p>
		<p>Paper's new Title: <input type="text" name="p_new_title" /></p>
		<p>Paper's new number of Authors: <input type="text" name="p_new_nofA" /></p>
		<p>Paper's new Abstract: <input type="text" name="p_new_abstract" /></p>
		<p>Paper's new number of Topics: <input type="text" name="p_new_nofT" /></p>
		<p>Paper's new Result: <input type="text" name="p_new_result" /></p>
		<p><input type="submit" value = "Next"/></p>
        	</form>
		<?php
                
            }
            $conn->close();
        ?>

    </body>
</html>
