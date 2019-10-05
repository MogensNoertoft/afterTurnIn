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
			<TR>
				<TD>
					<INPUT type="button" id="buttonfrugtgront" onclick="selectgroup(['frugtgrønt'])" value="frugt og grønt"/>
				</TD>
				<TD>
					<INPUT type="button" id="buttonradiotv" onclick="selectgroup(['radiotv'])" value="radio og TV"/>
				</TD>
				<TD>
					<INPUT type="button" id="buttonfrugttv" onclick="selectgroup(['frugtgrønt','radiotv'])" value="Begge varegrupper"/>
				</TD>
			</TR>
		</TABLE>
		
		<form method="get" id="selectform">
			<INPUT type="hidden" name="selectedgroup" id="selectedgroup" value="VareGruppe = 'frugtgrønt'" />
		</FORM>
		<form method="get" id="selectbeskrivelseform" action="DBBeskrivelse.php">
			<INPUT type="hidden" name="selectedbeskrivelse" id="selectedbeskrivelse" value="VareGruppe = 'frugtgrønt'" />
		</FORM>
		<table>  
		<?PHP
			$selectgroup = $_GET["selectedgroup"];
			$connect = mysqli_connect("localhost", "root", "", "db1");      
			$query = "SELECT * FROM varetabel1 ".$selectgroup ;#." ORDER BY id DESC";  
		
			#$query = "SELECT * FROM varetabel1";
			#echo '<script>alert("query '.$query.'")</script>'; 
			$result = mysqli_query($connect, $query);  		
			while($row = mysqli_fetch_array($result))  
			{  
				echo '  
					<tr>  
						<td onclick="selectbeskrivelse('. $row["ID"] .')">
							'.$row['Overskrift'].'
						</td>
					</TR>
					<TR>
						<td onclick="selectbeskrivelse('. $row["ID"] .')">  <!--ID, Overskrift, VareBillede, Pris, Varebeskrivelse, VareGruppe-->
							<img src="data:image/jpeg;base64,'.base64_encode($row['VareBillede'] ).'" height="40" width="40" class="img-thumnail" />  
						</td>  
						<td onclick="selectbeskrivelse('. $row["ID"] .')">
							'.$row['Pris'].'
						</td>
					</tr>  
				 ';
			}
		
			
		?>
		</table>
	</BODY>
</HTML>
