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
		$title=$_GET['Title'];
                $sql0="SELECT Author_ID FROM Paper_A_List WHERE Title='" .$title."'"; 
		$sql1="SELECT Name , Surname FROM Author WHERE Author.ID IN(" .$sql0. ")"; //statement that i changed
		$result = $conn->query($sql1);
		$sql0="SELECT Topic FROM Paper_T_List WHERE Title='" .$title."'"; 
		$result1 = $conn->query($sql0);
		//look here and add viewing papers author list
                        

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
                    echo "The Author table is empty.<br />";
                }
                if ($result1->num_rows > 0) {
                    //echo $result->num_rows;
                    ?>
                    <table border = 1>
                        <tr>                        
                            <th>Topic Name</th>                                                      
                    <?php

                    // output data of each row
                    while($row = $result1->fetch_assoc()) {
                        ?>
                        <tr>                        
                            <td><?php echo $row["Topic"]; ?></td>                                               
                        </tr>
                        <?php
                    }

                    ?>
                    </table>
                    <?php
                } else {
                    echo "The Topic table is empty.<br />";
                }
		if ($conn->query($sql0)) {			
			echo "You're viewing paper's authors and topics successfully <br />";
                    	echo "<a href = 'view_P.php'>Go back</a>";
			                    	
                } else{
                    	echo "Error viewing authors: " . $conn->error;
                }
                
            }
            $conn->close();
        ?>

    </body>
</html>
