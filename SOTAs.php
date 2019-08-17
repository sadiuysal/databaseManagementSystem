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
		
                $sql="SELECT * FROM Topic" ; 
	
		$result = $conn->query($sql);
	
                        
                if ($result->num_rows > 0) {
                    //echo $result->num_rows;
                    ?>
                    <table border = 1>
                        <tr>                        
                            <th>Topic Name</th>
                            <th>Sota Result</th>
                            <th>Paper Title which SOTA achieved</th>

                           
                    <?php

                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>                        
                            <td><?php echo $row["Name"]; ?></td>
                            <td><?php echo $row["SOTA_Result"]; ?></td>
                            <td><?php echo $row["Title"]; ?></td>                            
                        </tr>
                        <?php
                    }

                    ?>
                    </table>
                    <?php
                } else {
                    echo "The SOTA-Topic table is empty.<br />";
                }
		if ($conn->query($sql)) {			
			echo "You're viewing SOTA results of topics successfully <br />";
                    	echo "<a href = 'admin.php'>Go back</a>";
			                    	
                } else{
                    	echo "Error viewing SOTA results: " . $conn->error;
                }
                
            }
            $conn->close();
        ?>

    </body>
</html>
