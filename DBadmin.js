function NewItem() 
{
    document.getElementById("overskrift").value = "";
	document.getElementById("pris").value = "";
	document.getElementById("varebeskrivelse").value = "";	
	document.getElementById("varegruppe").value = "";	
}
    
function selectItem(item)
{
	document.getElementById("inputmyform").value = item;
	document.getElementById("myform").submit();
}

function checkfunction(ID,Overskrift,Pris,Varebeskrivelse,VareGruppe)
{
	//alert("checkfunction" +ID+Overskrift+Pris+Varebeskrivelse+VareGruppe); denne linje kan bruges til at debugge koden
	document.getElementById("idnumber").value = ID;
	document.getElementById("overskrift").value = Overskrift;
	document.getElementById("pris").value = Pris;
	document.getElementById("varebeskrivelse").value = Varebeskrivelse;
	document.getElementById("varegruppe").value = VareGruppe;
	//alert(document.getElementById("overskrift").value); denne linje kan bruges til at debugge koden
}

function onloadimage()
{
	var curFiles = document.getElementById("image").files;
	//alert(curFiles.length); denne linje kan bruges til at debugge koden
	if(curFiles.length < 1)
		alert("ingen billed data");
	else
		document.getElementById("imgdisplay").src = window.URL.createObjectURL(curFiles[0]);
	//document.getElementById("imgdisplay").src = '"data:image/jpeg;base64,' ;//+ getbase64(document.getElementById("image").files[0])+'"';
	//alert("image " + document.getElementById("imgdisplay").src);
}

function deleteRow(ID)
{
	document.getElementById("deleteid").value = ID;
	document.getElementById("deleteform").submit();
}