// ASCII only
function bytesToString(buffer) {
    return String.fromCharCode.apply(null, new Uint8Array(buffer));
}

// ASCII only
function stringToBytes(string) {
    var array = new Uint8Array(string.length);
    for (var i = 0, l = string.length; i < l; i++) {
        array[i] = string.charCodeAt(i);
    }
    return array.buffer;
}



//the bluefruit UART Service
var blue ={
	serviceUUID: '6e400001-b5a3-f393-e0a9-e50e24dcca9e',
    txCharacteristic: '6e400002-b5a3-f393-e0a9-e50e24dcca9e', // transmit is from the phone's perspective
    rxCharacteristic: '6e400003-b5a3-f393-e0a9-e50e24dcca9e'  // receive is from the phone's perspective
}

var ConnDeviceId;
var bleDeviceName;
var deviceList =[]; //this list will contain the current list of bluetooth devices we are connected to. Type: String[] devicelist
var list = document.getElementById("bleDeviceList");
var debug=true;
var timeOutActiveValue = undefined;
var ref //pointer til browser vindue

alert("timer kører2");
timerStartStop("start");

 
function onLoad(){
	document.addEventListener('deviceready', onDeviceReady, false);
    bleDeviceList.addEventListener('touchstart', conn, false); // assume not scrolling
	
	window.open = codova.InAppBrowser.open;
	//document.addEventListener("deviceready", onDeviceReady, false);
	

}

function onDeviceReady(){ 
	refreshDeviceList();
}

	 
function refreshDeviceList(){
	document.getElementById("bleDeviceList").innerHTML = ''; // empties the list
	if (cordova.platformId === 'android') { // Android filtering is broken
		ble.scan([], 5, onDiscoverDevice, onError);
	} else {
		ble.scan([blue.serviceUUID], 5, onDiscoverDevice, onError);
	}
}


function onDiscoverDevice(device){
	if(device.name == "radiotv" || device.name == "frugtgront"){
		if(!debug)
		{
		test();
		
		var listItem = document.createElement('li');
        html = device.name;
		listItem.innerHTML = html;
        listItem.classList.add('active');
		document.getElementById("bleDeviceList").appendChild(listItem);
        }
		else
		{
		var testgroups = ['brevpapir','radiotv','frugtgront', 'shampoo'];
		
		for(var i=0;i<testgroups.length;i++)
		{
			var listItem = document.createElement('li');
			//html = device.name; 
			html = testgroups[i];
			listItem.innerHTML = html;
			listItem.classList.add('active');
			document.getElementById("bleDeviceList").appendChild(listItem);
			deviceList.push(html);
		}
        
		//call of test() has been moved to after listItem has been added ????????
		test(deviceList);
		}
        /*var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
			x = document.getElementById("debugDiv");
			x.innerHTML += "onreadystatechange"; 
			x.innerHTML += String(this.readyState) + String(this.status)+ "<br>";
            if(this.readyState == 4 && this.status == 0) {
				x.innerHTML += String(this.response);
				
				if(this.response == "")
					this.response += "<P>vores data er ikke kommet</P>";
			
                document.getElementById("tilbud").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "172.20.10.3/DBDisplay.php", true); //method GET has a limitation - I have read 8K data
        xhttp.send(); */
	}
}


function conn(){
	var  deviceTouch= event.srcElement.innerHTML;
	document.getElementById("debugDiv").innerHTML =""; // empty debugDiv
	var deviceTouchArr = deviceTouch.split(",");
	bleDeviceName = deviceTouchArr[0];
	makeSelectedDeviceList(bleDeviceName);
	document.getElementById("debugDiv").innerHTML += "Du vil kun se: <br>"+deviceTouchArr[0]+" tilbud"; //for debug:
    /*
	if(event.srcElement.classList.contains('inactive')){
        event.srcElement.classList.remove('inactive');
        event.srcElement.classList.add('active');
    } else {
        event.srcElement.classList.remove('active');
        event.srcElement.classList.add('inactive');
    }
	*/
	timerStartStop("stop");
	test(deviceList);
 }
 
function onError(reason)  {
	alert("ERROR: " + reason); // real apps should use notification.alert
}


function test(devList){
	var url;
	if (debug) 
	{ 
		str=selectgroup(devList); 
		alert("str of devicelist = "+str);
	}
	else
		str=selectgroup(['radiotv']); 
	if(debug)
		url='http://192.168.0.29/DBDisplay.php?selectedgroup=' + str;
	else
		url='http://192.168.0.29/DBDisplay.php?selectedgroup=' + selectgroup(['radiotv']);
	openBrowser(url);
}

function openBrowser(url) {
   var target = '_blank';
   var options = "location=no";
   if(debug) options = "height=50, width=10";
	ref = cordova.InAppBrowser.open(url, target, options);
	ref.addEventListener('exit', winClose, false);
	//timerStartStop("stop"); //Stop timer indtil browser bliver lukket.
}

function selectgroup(grupper) //grupper i DB hedder PT frugtgrønt og radiotv - denne funktion er til videre udvikling
{
	var str="";
	if(grupper.length>0)
		for(var i=0;i<grupper.length;i++)
		{
			if(i<1)
				str = "WHERE VareGruppe = '" + grupper[i] + "'";
			else
				str = str + " OR VareGruppe = '" + grupper[i] + "'";
		}
	else 
		str="";
	return str;
}

//bliver brugt når man vælger en gruppe at vise, selvom telefonen kan se flere varegrupper vises kun den valgte.
function makeSelectedDeviceList(onlyItem)
{
	while(deviceList.length>0)
		deviceList.pop();
	deviceList.push(onlyItem);
}

function timerStartStop(value)
{
	if(value == "start" && timeOutActiveValue == undefined)
	{
		timeOutActiveValue = setTimeout("window.location.reload();",20000); //reload siden hvert 20. sekund. Dermed genindlæses Bluetooth-liste	
		alert("timer kører");
	}
	if(value == "stop")
	{
		clearTimeout(timeOutActiveValue);
		timeOutActiveValue = undefined;
		alert("Timer Stoped");
	}	
}

function winClose()
{
	alert("closeing browser window");
	ref.close();
	alert ("Timer kører1");
	timerStartStop("start"); //genstart timer
	document.getElementById("debugDiv").innerHTML ="";
}
/* ----------------------------------------------------------------------------------------*/
/* -------------------------- GARBAGE CODE ------------------------------------------------*/
/* ----------------------------------------------------------------------------------------*/

/* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
/* This code has been a navigation bar but hasn't been used yet */
/*
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "242px";
  document.getElementById("enhed").style.marginLeft = "242px";
}
*/
/* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
/*
function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft = "-8px";
  document.getElementById("enhed").style.marginLeft = "-8px";
}
*/