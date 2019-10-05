function selectgroup(grupper) //grupper i DB hedder PT frugtgrønt og radiotv
{
	var str="";
	for(var i=0;i<grupper.length;i++)
	{
		if(i<1)
			str = "WHERE VareGruppe = '" + grupper[i] + "'";
		else
			str = str + " OR VareGruppe = '" + grupper[i] + "'";
	}
	document.getElementById("selectedgroup").value = str;
	//alert(document.getElementById("selectedgroup").value);
	document.getElementById("selectform").submit();
}

function selectbeskrivelse(ID) //bruges til at hente varebeskrivelse i seperat form.
{
	document.getElementById("selectedbeskrivelse").value = ID;
	alert("selectedbeskrivelse " + document.getElementById("selectedbeskrivelse").value);
	document.getElementById("selectbeskrivelseform").submit();
}
