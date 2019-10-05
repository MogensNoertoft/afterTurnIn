<?php  
 $connect = mysqli_connect("localhost", "root", "", "db1");  
 if(isset($_POST["updateitem"])) 	 
 {  
	$overskrift = $_POST["overskrift"];
	$pris = $_POST["pris"];
	$varebeskrivelse =$_POST["varebeskrivelse"];
	$varegruppe =$_POST["varegruppe"];
	
		
	  $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  
	  $query = "INSERT INTO varetabel1(Overskrift, VareBillede, Pris, Varebeskrivelse, VareGruppe) VALUES ('$overskrift','$file','$pris','$varebeskrivelse','$varegruppe')";  
	  #$query = "INSERT INTO tbl_images(name) VALUES ('$file')"; 
	  if(mysqli_query($connect, $query))  
	  {  
		   #echo '<script>alert("Image Inserted into Database")</script>';  
	  } 
	  #echo '<script>alert("Overskrift '.$overskrift.'")</script>'; 
	  #echo '<script>alert("fil '.$file.'")</script>'; 
	  #echo '<script>alert("pris '.$pris.'")</script>'; 
	  #echo '<script>alert("varebeskrivelse '.$varebeskrivelse.'")</script>'; 
}  

 if(isset($_POST["deleteid"]))
{
	$deleteid = $_POST["deleteid"];
	$query = "DELETE FROM varetabel1 WHERE ID=" .$deleteid ;
	if(mysqli_query($connect, $query))  
	{  
		#echo '<script>alert("row deleted in Database")</script>';  
	}
} 
    
		$query = "SELECT * FROM varetabel1 ORDER BY id DESC";  
		$result = mysqli_query($connect, $query);  
         
 ?>
 
<!doctype HTML>
<HTML>
	<HEAD>

			<script type="text/javascript" src="DBadmin.js"></script> 
			<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  -->
            <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  -->
            <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  -->
	</HEAD>
	<BODY>

		
		
        <INPUT type="button" id="NewItem" onclick="NewItem()" value="New Item"></INPUT>
        <!-- <INPUT type="button" id="PriorItem" onclick = "PriorItem()" value="Prior item"></INPUT>
        <INPUT type="button" id="NextItem" onclick = "NextItem()" value="Next item"></INPUT> -->
        
        <br>
        <br>
		<form  method="post" name="myform" id="myform" action="DBadmin.php">
			<input type="hidden" name="inputmyform" id="inputmyform" value=""  />
		</form>
        
		<form  method="POST" name="deleteform" id="deleteform" action="DBadmin.php">
			<input type="hidden" name="deleteid" id="deleteid" value=""  />
		</form>
        <!-- <form method="post" enctype="multipart/form-data">  -->
        <form  method="POST" enctype="multipart/form-data">
			<input type="hidden" id="idnumber" name="idnumber" />
			
			<p><b>Overskrift</b></p>
			<input type="text" id="overskrift" name="overskrift" value=""></input>
			<br><br>
			<!-- <img src="" height="100" width="100" id="imgdisplay" />  -->
			<img src="" id="imgdisplay" height="100" width="100" />
			 <br><br>
			 <input type="file" name="image" id="image" onchange="onloadimage()"/>  
			 <br />  
			 <!-- <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" /> --> <BR>
			<p><b>pris</b></p>
			<input type="text" name="pris" id="pris"></input>
			<br><br>
			<p><b>Varebeskrivelse</b></p>
			<input type="text" name="varebeskrivelse" id="varebeskrivelse"></input>
			<br><br>
			<p><b>Varegruppe</b></p>
			 <select id="varegruppe" name="varegruppe" size="1">
				<option value=""></option>
				<option value="frugtgrønt">frugt og grønt</option>
				<option value="radiotv">Radio og TV</option>
			  </select>
			<br>
			<br>
			<INPUT type="submit" name="updateitem" id="updateitem" value="OK"></INPUT>
		</form>
		
		<br><br>
        
		<table>  
                    <tr>
						 <th>ID</th>
						 <th>Overskrift</th>
						 <th>Image</th>
						 <th>Pris</th>
						 <th>Varebeskrivelse</th>
						 <th>VareGruppe</th>
					</tr>  
                <?php  
                while($row = mysqli_fetch_array($result))  
                {  
                     echo '  
                          <tr>  
                               <td onclick="selectItem('. $row["ID"] .')">
									'. $row['ID'] .'
							   </td>
							   <td onclick="selectItem('. $row["ID"] .')">
									'.$row['Overskrift'].'
							   </td>
							   <td onclick="selectItem('. $row["ID"] .')">  <!--ID, Overskrift, VareBillede, Pris, Varebeskrivelse, VareGruppe-->
                                    <img src="data:image/jpeg;base64,'.base64_encode($row['VareBillede'] ).'" height="40" width="40" class="img-thumnail" />  
                               </td>  
							   <td onclick="selectItem('. $row["ID"] .')">
									'.$row['Pris'].'
							   </td>
							   <td onclick="selectItem('. $row["ID"] .')">
									'.$row['Varebeskrivelse'].'
							   </td>
							   <td onclick="selectItem('. $row["ID"] .')">
									'.$row['VareGruppe'].'
							   </td>
							   <td>
									<input type="button" value="DELETE" onclick="deleteRow('. $row['ID'] .')"
							   </td>
						   </tr>  
                     ';  
                }  
                ?>  
                </table>  
			<?PHP
			if(isset($_POST["inputmyform"]))
			{
				$x = $_POST["inputmyform"];
				$query = "SELECT * FROM varetabel1 WHERE ID=" .$x ;
				#echo '<script>alert("'.$query.'")</script>';
				$result1 = mysqli_query($connect, $query);  
				#echo '<script>alert("Database fetch done!")</script>';
				$row = mysqli_fetch_array($result1);
				echo '<script>checkfunction(
				'.$row['ID'].',
				"'.$row['Overskrift'].'",
				"'.$row['Pris'].'",
				"'.$row['Varebeskrivelse'].'",
				"'.$row['VareGruppe'].'")</script>';
			}
			?>

	</BODY>
</HTML>
<script>  
 $(document).ready(function(){  
      $('#updateitem').click(function(){  
           var image_name = $('#image').val();  
           if(image_name == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#image').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#image').val('');  
                     return false;  
                }  
           }  
      });  
 });  
 </script>

