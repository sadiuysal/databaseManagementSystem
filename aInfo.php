<html>
    <head>
        <title></title>
    </head>
    <body>
	<?php
	session_start();
        $_SESSION['oprNumber']=$_SESSION['oprNumber'];
	$_SESSION['p_title']=$_GET['p_title'];
	
	
	if($_SESSION['oprNumber']==3){
	?>
		<form action="sql.php" method="get">
		<?php
		$_SESSION['p_nofA']=$_GET['p_nofA'];
		$_SESSION['p_abstract']=$_GET['p_abstract'];
		$_SESSION['p_nofT']=$_GET['p_nofT'];
		$_SESSION['p_result']=$_GET['p_result']; 
		for ($i = 1; $i <= $_GET['p_nofA']; $i++) {
    			 echo "Author ". $i." Name: "?><input type="text" name="name[]" /></p><?php
			 echo "Author ". $i." Surname: "?><input type="text" name="surname[]" /></p>
		<?php
		}
		
		 
		for ($k = 1; $k <= $_GET['p_nofT']; $k++) {
    			 echo "Topic ". $k."'s Name: "?><input type="text" name="Tname[]" /></p><?php
		}
		
		?>
         	<p><input type="submit" value = "Next"/></p>
        	</form>	
	<?php	
	}else if($_SESSION['oprNumber']==4){
	?>
		<form action="sql.php" method="get"><?php
		$_SESSION['p_new_nofA']=$_GET['p_new_nofA'];
		$_SESSION['p_new_abstract']=$_GET['p_new_abstract'];
		$_SESSION['p_new_nofT']=$_GET['p_new_nofT'];
		$_SESSION['p_new_title']=$_GET['p_new_title'];
		$_SESSION['p_new_result']=$_GET['p_new_result']; 
		for ($i = 1; $i <= $_GET['p_new_nofA']; $i++) {
    			 echo "New Author ". $i." Name: "?><input type="text" name="name[]" /></p><?php
			 echo "New Author ". $i." Surname: "?><input type="text" name="surname[]" /></p>
		<?php
		}
		
		 
		for ($k = 1; $k <= $_GET['p_new_nofT']; $k++) {
    			 echo "New Topic ". $k."'s Name: "?><input type="text" name="Tname[]" /></p><?php
		}
		
		?>
         	<p><input type="submit" value = "Next"/></p>
        	</form>	
	<?php	
	}		
	?>	
    </body>
</html>

