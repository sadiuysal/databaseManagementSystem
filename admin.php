<html>
    <head>
        <title>Operations</title>
    </head>
    <body>

        <?php
        session_start();
            $servername = "localhost";
            $username = "root";
            $dbname = "DB_3";
            $userType=$_SESSION['userType'];

            // Create connection
            $conn = new mysqli($servername, $username, "", $dbname);

            // Check connection
            if ($conn->connect_error) {

                die("Connection failed: " . $conn->connect_error);
            }else{
            	$trigger = "CREATE TRIGGER upd AFTER INSERT ON Paper
 FOR EACH ROW UPDATE Topic SET SOTA_Result = (SELECT MAX(Result) FROM Paper WHERE EXISTS (SELECT * FROM Paper_T_List  WHERE Paper.Title = Paper_T_List.Title AND Paper_T_List.Topic = Topic.Name))";
 		$conn->query($trigger); 
 		$trigger2 = "CREATE TRIGGER upd2 AFTER DELETE ON Paper
 FOR EACH ROW UPDATE Topic SET SOTA_Result = (SELECT MAX(Result) FROM Paper WHERE EXISTS (SELECT * FROM Paper_T_List  WHERE Paper.Title = Paper_T_List.Title AND Paper_T_List.Topic = Topic.Name))";
 		$conn->query($trigger2);
 		$trigger3 = "CREATE TRIGGER upd3 AFTER UPDATE ON Paper
 FOR EACH ROW UPDATE Topic SET SOTA_Result = (SELECT MAX(Result) FROM Paper WHERE EXISTS (SELECT * FROM Paper_T_List  WHERE Paper.Title = Paper_T_List.Title AND Paper_T_List.Topic = Topic.Name))";
 		$conn->query($trigger3); 
            	if($userType=="admin"){
		?>
            	<form action="add_A.php" method="get">
         	<p><input type="submit" value = "Add Author"/></p>
        	</form>
		<form action="update_A.php" method="get">
         	<p><input type="submit" value = "Update Author"/></p>
        	</form>
		<form action="delete_A.php" method="get">
         	<p><input type="submit" value = "Delete Author"/></p>
        	</form>
		<form action="add_P.php" method="get">
         	<p><input type="submit" value = "Add Paper"/></p>
        	</form>
		<form action="update_P.php" method="get">
         	<p><input type="submit" value = "Update Paper"/></p>
        	</form>
		<form action="delete_P.php" method="get">
         	<p><input type="submit" value = "Delete Paper"/></p>
        	</form>
        	<?php
        	} ?>
		<form action="view_A.php" method="get">
         	<p><input type="submit" value = "View Authors"/></p>
        	</form>
		<form action="view_P.php" method="get">
         	<p><input type="submit" value = "View Papers"/></p>
        	</form>
		<form action="view_T.php" method="get">
         	<p><input type="submit" value = "View Topics"/></p>
        	</form>
        	<form action="papers_A.php" method="get">
		<p>Author's Name: <input type="text" name="a_name" />Surname:<input type="text" name="a_surname" /><input type="submit" value = "Find papers of this Author"/></p>
         	<p></p>
        	</form>
		<form action="SOTAs.php" method="get">
         	<p><input type="submit" value = "SOTA Results of Topics"/></p>
        	</form>
        	<form action="papers_T.php" method="get">
        	<p>Topic Name: <input type="text" name="t_name" /><input type="submit" value = "Find papers on this topic"/></p>
        	</form>
        	<form action="rank_A.php" method="get">
         	<p><input type="submit" value = "Rank authors by SOTA papers"/></p>
        	</form>
        	<form action="search.php" method="get">
        	<p>Keyword: <input type="text" name="name" /><input type="submit" value = "Search this keyword in papers"/></p>
        	</form>
		<form action="co_A.php" method="get">
		<p>Author's Name: <input type="text" name="name" />Surname:<input type="text" name="surname" /><input type="submit" value = "Find co-authors of this Author"/></p>
         	<p></p>
        	</form>
		<form action="form.php" method="get">
         	<p><input type="submit" value = "Log out"/></p>
        	</form>
		<?php
            }

            $conn->close();
        ?>

    </body>
</html>
