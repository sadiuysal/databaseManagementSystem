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
                $sql = "SELECT * FROM Paper";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    //echo $result->num_rows;
                    ?>
                    <table border = 1>
                        <tr>                        
                            <th>Title</th>
                            <th>Abstract</th>
			    <th>Number of Authors</th>			    					
                            <th>Number of Topics</th>
			    <th>Result</th>
			    <th>View Authors and Topics</th>
                           
                    <?php

                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
			    <td><?php echo $row["Title"]; ?></td>
                            <td><?php echo $row["Abstract"]; ?></td>
			    <td><?php echo $row["NumberofAuthors"]; ?></td>
                            <td><?php echo $row["NumberofTopics"]; ?></td>
			    <td><?php echo $row["Result"]; ?></td>
			    <td>
                                <a href = "list.php?Title=<?php echo $row["Title"]; ?>"><img src = "img/view.png" alt = "View" /></a>                             
                            </td>                        
                                                        
                        </tr>
                        <?php
                    }

                    ?>
                    </table>
                    <?php
                } else {
                    echo "The Paper table is empty.<br />";
                }
		if ($conn->query($sql)) {			
			echo "You're viewing papers successfully <br />";
                    	echo "<a href = 'admin.php'>Go back</a>";
			                    	
                } else{
                    	echo "Error viewing papers: " . $conn->error;
                }
                
            }
            $conn->close();
        ?>

    </body>
</html>
