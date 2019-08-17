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
	    	$oprNumber=$_SESSION['oprNumber'];
	    
	
	    $sqlCheck=TRUE;

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }else
            {
		if($oprNumber=="0"){
			// Insert the author
			$a_name=$_GET['a_name'];
	    		$a_surname=$_GET['a_surname'];
                	$sql = "INSERT INTO Author (Name, Surname, ID) VALUES ('" .$a_name . "' , '" . $a_surname . "' , NULL ) " ;	
		}
		else if($oprNumber=="1"){
			// Update the author
			$a_name=$_GET['a_name'];
	    		$a_surname=$_GET['a_surname'];
                	$sql = "UPDATE Author SET Name ='". $_GET['a_new_name'] ."', Surname ='".$_GET['a_new_surname']."' WHERE Author.ID=(SELECT ID FROM (select * from Author) AS table_2  WHERE Name='" .$a_name."' and Surname = '" .$a_surname. "')";	
		}
		else if($oprNumber=="2"){
			// Delete the author
			$a_name=$_GET['a_name'];
	    		$a_surname=$_GET['a_surname'];
			$sql0="SELECT ID FROM (select * from Author) AS table_2  WHERE Name='" .$a_name."' and Surname = '" .$a_surname. "'";
            		$sql = "DELETE FROM Author WHERE Author.ID=($sql0)" ;
			$sqlx=$conn->query($sql0);
			if(!($sqlx->num_rows > 0)){
				echo "No such Author exists.<br />";
                                $sqlCheck=FALSE;	
			}
			//code for update paper's author list
			$sql1="DELETE FROM Paper_A_List WHERE ID=($sql0)";
			$conn->query($sql1);	
		}
		else if($oprNumber=="3"){
			// Insert the paper
			$p_title=$_SESSION['p_title'];
	    		$p_nofA=$_SESSION['p_nofA'];
			$p_abstract=$_SESSION['p_abstract'];
	    		$p_nofT=$_SESSION['p_nofT'];
			$p_result=$_SESSION['p_result'];
			$name=$_GET['name'];
			$surname=$_GET['surname'];
			$Tname=$_GET['Tname'];				
			for ($i = 0; $i < $p_nofA; $i++) {
				$sql0="SELECT ID FROM (select * from Author) AS table_2  WHERE Name='" .$name[$i]."' and Surname = '" .$surname[$i]. "'";
				$sqlx=$conn->query($sql0);
				if(!($sqlx->num_rows > 0)){
					echo "Could not find Author named as ". $name[$i] ." ".$surname[$i]." ,New author added.<br />";
					$sql = "INSERT INTO Author (Name, Surname, ID) VALUES ('" .$name[$i]."','" .$surname[$i].  "' , NULL ) " ; 										
                            	        $conn->query($sql); //new author added.
                	    	}
                	    	$sql = "INSERT INTO Paper_A_List (Title, Author_ID) VALUES ('" .$p_title."',(" .$sql0.  "))" ;//updated paper's author list
				$conn->query($sql); 						                  
						
			}
			for ($i = 0; $i < $p_nofT; $i++) { 
    				$sql = "INSERT INTO Paper_T_List (Title, Topic) VALUES ('" .$p_title."','" .$Tname[$i]. "') " ;
				$conn->query($sql); 
				$sql1="SELECT * FROM Topic WHERE Topic.Name='" .$Tname[$i]."'";                  					
				if(!($conn->query($sql1)->num_rows > 0)){
					echo "Could not find the Topic named as ".$Tname[$i]." ,New topic added.<br />"; //new topic added.
					$sql = "INSERT INTO Topic (Name, SOTA_Result, Title) VALUES ('" .$Tname[$i]. "' , '" . $p_result . "','".$p_title."') " ;
					$conn->query($sql); 	 										
                	    	}
			}
			$sql = "INSERT INTO Paper (Title,NumberofAuthors, Abstract, NumberofTopics, Result) VALUES ('" .$p_title . "' , '" . $p_nofA . "', '" . $p_abstract . "', '" . $p_nofT . "' , '" . $p_result . "' ) ";		
			
                		
		}else if($oprNumber=="4"){
			// Update the paper
			$p_title=$_SESSION['p_title'];
			$p_new_title=$_SESSION['p_new_title'];
	    		$p_new_nofA=$_SESSION['p_new_nofA'];
			$p_new_abstract=$_SESSION['p_new_abstract'];
	    		$p_new_nofT=$_SESSION['p_new_nofT'];
			$p_new_result=$_SESSION['p_new_result'];
			$name=$_GET['name'];
			$surname=$_GET['surname'];
			$Tname=$_GET['Tname'];
			$sql="SELECT Title FROM Paper WHERE Paper.Title='".$p_title."'" ;
			$sqlx=$conn->query($sql);
			if(!($sqlx->num_rows > 0)){
				echo "No such Paper exists.<br />";
                                $sqlCheck=FALSE;
                		
			}
			if($sqlCheck){
				$sql_author_del="SELECT ID FROM (select * from Paper_A_List ) AS table_2  WHERE Title='" .$p_title."'";//authors has possibility to update
				$sql_topic_del="SELECT Topic FROM (select * from Paper_T_List ) AS table_1  WHERE Title='" .$p_title."'";//topics has possibility to update
				$sql = "DELETE FROM Paper_A_List WHERE Paper_A_List.Title='".$p_title."'" ;//delete old authors relation
				$conn->query($sql);
				echo $conn->error;  
				$sql = "DELETE FROM Paper_T_List WHERE Paper_T_List.Title='".$p_title."'" ;//delete old topic relations
				$conn->query($sql);
				echo $conn->error; 
				for ($i = 0; $i < $p_new_nofA; $i++) {
					$sql0="SELECT ID FROM (select * from Author) AS table_2  WHERE Name='" .$name[$i]."' and Surname = '" .$surname[$i]. "'";
					$sql_author_del=$sql_author_del." MINUS (".$sql0.")" ; 
					$sqlx=$conn->query($sql0);
					if(!($sqlx->num_rows > 0)){
						echo "Could not find Author named as ". $name[$i] ." ".$surname[$i]." ,New author added.<br />";
						$sql = "INSERT INTO Author (Name, Surname, ID) VALUES ('" .$name[$i]."','" .$surname[$i].  "' , NULL ) " ; 							
                            			$conn->query($sql); //here new author added.
                	   		 } 
					$sql = "INSERT INTO Paper_A_List (Title, Author_ID) VALUES ('" .$p_new_title."',(" .$sql0. ")) " ;//here update paper's author list 
					$conn->query($sql);
					echo $conn->error;
    					
						                  
						
				}
				for ($i = 0; $i < $p_new_nofT; $i++) {
			        
    					$sql = "INSERT INTO Paper_T_List (Title, Topic) VALUES ('" .$p_new_title."','" .$Tname[$i].  "') " ; //insert new topic paper relationships
					$sql_topic_del=$sql_topic_del." MINUS (".$sql.")" ;
					$conn->query($sql);
					$sql0="SELECT * FROM Topic WHERE Topic.Name='" .$Tname[$i]. "'";               					
					if(!($conn->query($sql0)->num_rows > 0)){
						echo "Could not find the Topic named as ".$Tname[$i]." ,New topic added.<br />"; //new topic added.
						$sql = "INSERT INTO Topic (Name, SOTA_Result,Title) VALUES ('" .$Tname[$i]. "' , '" . $p_new_result ."','" .$p_new_title."')" ;
						$conn->query($sql);
					
                	    		}//else statement here means topic exist already so do necessary updates
				}
                        	$sql = "UPDATE Paper SET Title ='". $p_new_title ."', NumberofAuthors ='".$p_new_nofA."', Abstract ='".$p_new_abstract."', NumberofTopics ='".$p_new_nofT."', Result ='".$p_new_result."' WHERE Paper.Title='".$p_title."'";
			}else{
			$sql="";
			}
			

				
		}else if($oprNumber=="5"){
			// Delete the paper
			$p_title=$_GET['p_title'];
			$sql1="SELECT Title FROM Paper WHERE Paper.Title='".$p_title."'" ;
                        $sql = "DELETE FROM Paper WHERE Paper.Title='".$p_title."'" ;
			$sqlx=$conn->query($sql1);
			if(!($sqlx->num_rows > 0)){
				echo "No such Paper exists.<br />";
                                $sqlCheck=FALSE;
                		
			}
			if($sqlCheck==TRUE){
			        //trigger for SOTA
			        //delete code for paper author list	
			        //delete paper topic list
			}
		}
		if ($conn->query($sql)) {
			if($sqlCheck){
				echo "Table was updated successfully <br />";
                    		echo "<a href = 'admin.php'>Go back</a>";
			}
                    	
                } else{
                    	echo "Error updating record: " . $conn->error;
                }
                
            }
            $conn->close();
        ?>

    </body>
</html>
