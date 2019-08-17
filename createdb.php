<html>
    <head>
        <title></title>
    </head>
    <body>
	<?php
	$servername = "localhost";
	$username = "root";


	// Create connection
	$conn = new mysqli($servername, $username);

	// Check connection
	if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
	}

	// Create database
	$sql = "CREATE DATABASE DB_3";
	$sql1="CREATE TABLE DB_3.Author ( Name TEXT NOT NULL , Surname TEXT NOT NULL , ID INT NOT NULL AUTO_INCREMENT , PRIMARY KEY (ID)) ENGINE = InnoDB";
	$sql2="CREATE TABLE DB_3.Paper ( Title TEXT NOT NULL , NumberofAuthors INT NOT NULL , Abstract TEXT NOT NULL , NumberofTopics INT NOT NULL , Result INT NOT NULL , PRIMARY KEY (Title(40))) ENGINE = InnoDB";
	$sql3="CREATE TABLE DB_3.Topic ( Name TEXT NOT NULL , SOTA_Result INT NOT NULL , Title TEXT NOT NULL , PRIMARY KEY (Name(30))) ENGINE = InnoDB";
	$sql4="CREATE TABLE DB_3.Paper_A_List ( Title TEXT NOT NULL , Author_ID INT NOT NULL , PRIMARY KEY (Title(40),Author_ID)) ENGINE = InnoDB";
	$sql5="CREATE TABLE DB_3.Paper_T_List ( Title TEXT NOT NULL , Topic TEXT NOT NULL , PRIMARY KEY (Title(40),Topic(30))) ENGINE = InnoDB";

	if (($conn->query($sql) === TRUE)&&($conn->query($sql5) === TRUE)&&($conn->query($sql1) === TRUE)&&($conn->query($sql2) === TRUE)&&($conn->query($sql3) === TRUE)&&($conn->query($sql4) === TRUE)) {
    		echo "Database created successfully.<br />";
    		
				
		?>
		<form action="form.php" method="get">
         	<p><input type="submit" value = "Next"/></p>
        	</form>
	<?php
	} else {
    		echo "Error creating database: " . $conn->error;
	}
	
	$conn->close();
	?>
	
    </body>
</html>

