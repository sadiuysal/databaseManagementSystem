<html>
    <head>
        <title></title>
    </head>
    <body>

        <?php
	    session_start();
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "DB_3";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }else
            {
		// List records
                $sql = "SELECT Name FROM Topic";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    //echo $result->num_rows;
                    ?>
                    <table border = 1>
                        <tr>                        
                            <th>Topic Name</th>
                            
                           
                    <?php

                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>                        
                            <td><?php echo $row["Name"]; ?></td>
                                                        
                        </tr>
                        <?php
                    }

                    ?>
                    </table>
                    <?php
                } else {
                    echo "The Topic table is empty.<br />";
                }
		if ($conn->query($sql)) {			
			echo "You're viewing topics successfully. <br />";
                    	echo "<a href = 'admin.php'>Go back</a>";
			                    	
                } else{
                    	echo "Error viewing topics: " . $conn->error;
                }
                
            }
            $conn->close();
        ?>

    </body>
</html>
