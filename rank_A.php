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
                $sql0="SELECT * FROM Paper_A_List WHERE Title IN (SELECT Title FROM Topic) GROUP BY Author_ID ORDER BY COUNT(Author_ID) DESC";
		$result = $conn->query($sql0);
                        
                if ($result->num_rows > 0) {
                    //echo $result->num_rows;
                    ?>
                    <table border = 1>
                        <tr>                        
                            <th>Name</th>
                            <th>Surname</th>
                           
                    <?php

                    // output data of each row
                    while($row0 = $result->fetch_assoc()) {
                    	$sql="SELECT * FROM Author WHERE ID=(".$row0["Author_ID"].")";
                    	$result1 = $conn->query($sql);
                    	$row=$result1->fetch_assoc();
                    	

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
                    echo "The SOTA-Author relation table is empty.<br />";
                }           
		if ($conn->query($sql0)) {			
			echo "You're viewing SOTA-Author relation rank successfully <br />";
                    	echo "<a href = 'admin.php'>Go back</a>";
			                    	
                } else{
                    	echo "Error viewing SOTA-Author relation: " . $conn->error;
                }
                
            }
            $conn->close();
        ?>

    </body>
</html>
