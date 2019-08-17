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
            $name=$_GET['t_name'];
     
            $check=TRUE;

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }else
            {
		// List records
                $sql0="SELECT Name FROM  Topic  WHERE Name='" .$name."'";
                $sql="SELECT Title FROM  Paper_T_List WHERE Topic=($sql0)";
                $result = $conn->query($sql);
                if(($conn->query($sql0))->num_rows > 0){
                    if ($result->num_rows > 0) {
                    //echo $result->num_rows;
                    ?>
                    <table border = 1>
                        <tr>                        
                            <th>Paper's Title</th>
                            
                           
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
                   	 echo "This topic's paper table is empty";
                   	 echo "<a href = 'admin.php'>Go back</a>";
                   	 $check=FALSE;
                    }
                }else{
                    echo "Could not find topic named as ". $name .".<br />";
                    echo "<a href = 'admin.php'>Go back</a>";
                    $check=FALSE;              
                }
                
		if ($conn->query($sql)) {
			if($check){
				echo "You're viewing topic's papers successfully. <br />";
                    		echo "<a href = 'admin.php'>Go back</a>";
			}			
				                    	
                } else{
                    	echo "Error viewing topic's papers: " . $conn->error;
                }
                
            }
            $conn->close();
        ?>

    </body>
</html>
