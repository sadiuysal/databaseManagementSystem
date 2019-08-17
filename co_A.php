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
	    $name=$_GET['name'];
	    $surname=$_GET['surname'];
	    $sql0="SELECT * FROM Author WHERE ID IN (SELECT Author_ID FROM Paper_A_List WHERE Title IN (SELECT Title FROM Paper_A_List WHERE Author_ID=(SELECT ID FROM Author WHERE Name LIKE '$name'  and Surname LIKE '$surname')))"; //this statement 


	    // Create procedure
	    $sql = "CREATE DEFINER=`root`@`localhost` PROCEDURE coauthor(IN name TEXT, IN surname TEXT)\n"

    . "BEGIN\n"

    . "		(SELECT Author_ID FROM Paper_A_List WHERE Title IN (SELECT Title FROM Paper_A_List WHERE Author_ID=(SELECT ID FROM Author WHERE Name LIKE name  and Surname LIKE name))); END " ;
		

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
		$conn->query($sql);
		echo $conn->error;
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }else
            {		
		$sql="call coauthor($name,$surname)";		
		$result=$conn->query($sql0);

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
                    echo "The Co-author table is empty.<br />";
                }
		if ($conn->query($sql0)) {			
			echo "You're viewing co-author results successfully. <br />";
                    	echo "<a href = 'admin.php'>Go back</a>";
			                    	
                } else{
                    	echo "Error viewing results: " . $conn->error;
                }
                
            }
            $conn->close();
        ?>

    </body>
</html>
