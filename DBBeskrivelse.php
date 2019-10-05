<!doctype HTML>
<HTML>
	<HEAD>

			<script type="text/javascript" src="DBDisplay.js"></script> 
			<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  -->
            <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  -->
            <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  -->
	</HEAD>
	<BODY>
		<TABLE>
		<?PHP
			$selectedbeskrivelse = $_GET["selectedbeskrivelse"];
			$connect = mysqli_connect("localhost", "root", "", "db1");      
			$query = "SELECT Varebeskrivelse FROM varetabel1 WHERE ID = ".$selectedbeskrivelse ;#." ORDER BY id DESC";  
		
			#$query = "SELECT * FROM varetabel1";
			echo '<script>alert("query '.$query.'")</script>'; 
			$result = mysqli_query($connect, $query);  		
			while($row = mysqli_fetch_array($result))  
			{  
				echo '  
					<tr>  
						<td>
							'.$row['Varebeskrivelse'].'
						</td>
					</TR>
				';
			}
		?>
		</TABLE>
	
		<form method="get" id="selectbeskrivelseform" action="DBDisplay.php">
			<INPUT type="submit" value="tilbage" action="DBDisplay.php">
		</FORM>
	</BODY>
</HTML>
