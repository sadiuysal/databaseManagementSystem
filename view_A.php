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
                $sql = "SELECT Name, Surname FROM Author";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    //echo $result->num_rows;
                    ?>
                    <table border = 1>
                        <tr>                        
                            <th>Name</th>
                            <th>Surname</th>
                           
                    <?php

                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>                        
                            <td><?php echo $row["Name"]; ?></td>
                            <td><?php echo $row["Surname"]; ?></td>                            
                        </tr>
                        <?php
                    }

                    ?>
                    </table>
                    <?php
                } else {
                    echo "The Author table is empty";
                }
		if ($conn->query($sql)) {			
			echo "You're viewing authors successfully <br />";
                    	echo "<a href = 'admin.php'>Go back</a>";
			                    	
                } else{
                    	echo "Error viewing authors: " . $conn->error;
                }
                
            }
            $conn->close();
        ?>

    </body>
</html>
