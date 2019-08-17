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
	    $sub=$_GET['name'];

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }else
            {
		// List records
                $sql = "SELECT * FROM Paper WHERE (Title LIKE '%".$sub."%' OR Abstract LIKE '%".$sub."%')";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    //echo $result->num_rows;
                    ?>
                    <table border = 1>
                        <tr>                        
                            <th>Result Paper Title</th>
                            
                           
                    <?php

                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>                        
                            <td><?php echo $row["Title"]; ?></td>
                                                        
                        </tr>
                        <?php
                    }

                    ?>
                    </table>
                    <?php
                } else {
                    echo "The Result table is empty.<br />";
                }
		if ($conn->query($sql)) {			
			echo "You're viewing search results successfully. <br />";
                    	echo "<a href = 'admin.php'>Go back</a>";
			                    	
                } else{
                    	echo "Error viewing results: " . $conn->error;
                }
                
            }
            $conn->close();
        ?>

    </body>
</html>
