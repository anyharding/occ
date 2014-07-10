var dtCh= "/";
var minYear=1900;
var maxYear=2200;
 
// JavaScript Document
function isValidChar(objValue){
    if(objValue.value!=""){
	var  strError	="";
	var charpos = objValue.value.search("[^A-Za-z0-9 ]"); 
	var At=objValue.value.charAt(0);
	if(isNaN(objValue.value.charAt(0))==0){			  
	    return false;
	}
	else if(objValue.value.length > 0 &&  charpos >= 0){
	    if(!strError || strError.length ==0){ 
		return false;
	    //strError ="Only alpha-numeric characters allowed !!"; 
	    }//if
	    return false; 
	}
    }
    return true;
}

function isValidZip(objValue){
    if(objValue.value!=""){
	var  strError	="";
	var charpos = objValue.value.search("[^A-Za-z0-9- ]"); 
	var At=objValue.value.charAt(0);
	if(isNaN(objValue.value.charAt(0))==0){
	    return false;
	}
	else if(objValue.value.length > 0 &&  charpos >= 0){
	    if(!strError || strError.length ==0){
		return false;
	    //strError ="Only alpha-numeric characters allowed !!"; 
	    }//if
	    return false; 
	}
    }
    return true;
}

function isInteger(objValue){
    if(objValue.value!=""){
	var  strError	="";
	var charpos = objValue.value.search("[^0-9]"); 
	if(objValue.value.length > 0 &&  charpos >= 0){ 
	    if(!strError || strError.length ==0){ 
		return false;
	    // strError = "Only digits allowed "; 
	    }
	    return false; 
	}
    }
    return true;
}

function isReferenceNumber(objValue){
    if(objValue.value!=""){
	var  strError	="";
	var charpos = objValue.value.search("[^0-9]"); 
	if(objValue.value.length > 0 &&  charpos >= 0){ 
	    if(!strError || strError.length ==0){ 
		return false;
	    // strError = "Only digits allowed "; 
	    }
	    return false; 
	}
	if(objValue.value.length < 10){
	    return false;
	}
    }
    return true;
}
		
function isProperText(objValue)
{
	if(objValue.value!=""){
		var  strError	="";
		var charpos = objValue.value.search("[^A-Za-z0-9, ]");
		if(objValue.value.length > 0 &&  charpos >= 0){ 
			if(!strError || strError.length ==0){ 
				strError = "Only alphabetic characters allowed !!"; 
			}//if                             
			//   alert(strError + "\n ( Error character position " + eval(charpos+1)+")");
			return false; 
		}//if
	}
	return true;
}

function isText(objValue){
    if(objValue.value!=""){
	var  strError	="";				
	var charpos = objValue.value.search("[^A-Za-z]"); 
	if(objValue.value.length > 0 &&  charpos >= 0){ 
	    if(!strError || strError.length ==0){ 
		strError = "Only alphabetic characters allowed !!"; 
	    }//if                             
	    //   alert(strError + "\n ( Error character position " + eval(charpos+1)+")");
	    return false; 
	}//if
    }
    return true;
}
	
function isValidEmailFormat_(objValue){
    if(objValue.value!=""){
	var  strError	="";
	if(!validateEmailv2(objValue.value)){ 
	    strError ="Enter a valid Email Address!! ";
	    return false;
	}
    }
    return true;
}
	
function isDateMMDDYY(objValue){
	if(objValue.value!=""){
		if (isDate(objValue.value)==false){			
			return false;
		}
	}
	return true;
}
	
function isDateDDMMYY(objValue){
    if(objValue.value!=""){
	if (isDate2(objValue.value)==false){
	    return false;
	}
    }
    return true;
}
	
function isValidCellNo(objValue){
	if(objValue.value!=""){
		var  strError	="";
		var charpos = objValue.value.search(/\d{3}\-\d{3}\-\d{4}/); 
	  
		if(objValue.value.length > 0 &&  charpos ==-1){
			if(!strError || strError.length ==0){ 
				strError = "phone number you entered is not valid.\r\nPlease enter a phone number with the format xxx-xxx-xxxx."; 
			}
			return false; 
		}//if
	}
	return true;
}

function isValidEmailFormat(email){
	
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)){
	return (true);
    }
    return false;
}		
	
function isValidwebsite(website){
	if(/http:\/\/[w]{3}\.[A-Za-z0-9]+\.[A-Za-z]{2,3}/.test(website.value)){
	  return true;	
	}
	else{ 
		return false;
	}	
}
	
function isValidEmailFormat_old(email)
{
    if(email.length <= 0){
	return true;
    }
	
    var splitted = email.match("^(.+)@(.+)$");
    if(splitted == null) return false;
	
    if(splitted[1] != null ){	 
	var regexp_user=/^\"?[\w-_\.]*\"?$/;
	if(splitted[1].match(regexp_user) == null) return false;
    }
    if(splitted[2] != null){
	var regexp_domain=/^[\w-\.]*\.[A-Za-z]{2,4}$/;
	if(splitted[2].match(regexp_domain) == null){
	    var regexp_ip =/^\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\]$/;
	    if(splitted[2].match(regexp_ip) == null) return false;
	}// if
	return true;
    }
    return false;
}

function isInteger2(s){
	var i;
	for (i = 0; i < s.length; i++){   
		// Check that current character is number.
		var c = s.charAt(i);
		if (((c < "0") || (c > "9"))) return false;
	}
	// All characters are numbers.
	return true;
}

function stripCharsInBag(s, bag){
	var i;
	var returnString = "";
	// Search through string's characters one by one.
	// If character is not in bag, append to returnString.
	for (i = 0; i < s.length; i++){   
		var c = s.charAt(i);
		if (bag.indexOf(c) == -1) returnString += c;
	}
	return returnString;
}

function daysInFebruary (year){
	// February has 29 days in any year evenly divisible by four,
	// EXCEPT for centurial years which are not also divisible by 400.
	return (((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );
}

function DaysArray(n) {
	for (var i = 1; i <= n; i++) {
		this[i] = 31;
		if (i==4 || i==6 || i==9 || i==11) {this[i] = 30;}
		if (i==2) {this[i] = 29;}
	}	 
	return this;
}

function isDate(dtStr){
	var daysInMonth = DaysArray(12);
	var pos1=dtStr.indexOf(dtCh);
	var pos2=dtStr.indexOf(dtCh,pos1+1);
	var strMonth=dtStr.substring(0,pos1);
	var strDay=dtStr.substring(pos1+1,pos2);
	var strYear=dtStr.substring(pos2+1);
	strYr=strYear;
	if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1);
	if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1);
	for (var i = 1; i <= 3; i++) {
		if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1);
	}
	month=parseInt(strMonth);
	day=parseInt(strDay);
	year=parseInt(strYr);
	if (pos1==-1 || pos2==-1){	
		return false;
	}
	if (strMonth.length<1 || month<1 || month>12){	
		return false;
	}
	if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
		return false;
	}
	if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
		return false;
	}
	if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger2(stripCharsInBag(dtStr, dtCh))==false){
		return false;
	}
	return true;
}

function isDate2(dtStr){
    var daysInMonth = DaysArray(12);
    var pos1=dtStr.indexOf(dtCh);
    var pos2=dtStr.indexOf(dtCh,pos1+1);
    var strMonth=dtStr.substring(pos1+1,pos2);
    var strDay=dtStr.substring(0,pos1);
    var strYear=dtStr.substring(pos2+1);
    strYr=strYear;
    if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1);
    if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1);
    for (var i = 1; i <= 3; i++){
	if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1);
    }
    month=parseInt(strMonth);
    day=parseInt(strDay);
    year=parseInt(strYr);
    if (pos1==-1 || pos2==-1){
	return false;
    }
    if (strMonth.length<1 || month<1 || month>12){
	return false;
    }
    if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
	return false;
    }
    if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
	return false;
    }
    if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger2(stripCharsInBag(dtStr, dtCh))==false){
	return false;
    }
    return true;
}

//FOR HIDE AND SHOW 
function toggleSearch(whichLayer){
	if (document.getElementById){
		// this is the way the standards work
		var style2 = document.getElementById(whichLayer).style;
		
		if(style2.display == "block"){
			style2.display = "none";
		}else{
			style2.display = "block";
		}
	}
}
//COMPARE PASSWORDS FIELDS
function chkPWD(first, second){
	var el, msg = '';
	if (document.getElementById(first).value == '' || /^\s+$/.test(document.getElementById(first).value)){
		msg = 'Please enter a password.';
		el = first;
	}
	else if (document.getElementById(second).value == '' || /^\s+$/.test(document.getElementById(second).value)){
		msg = 'Please re-enter your password.';
		el = second;
	}
	else if (document.getElementById(second).value != document.getElementById(first).value){
		msg = 'Please ensure that your password & confirmed password are the same.';
		el = second;
	}
	if (msg){		
		return false;
	}
	return true;
}
function chkEmail(first,second){
	if (document.getElementById(second).value != document.getElementById(first).value){
		msg = 'Please ensure that your password & confirmed password are the same.';
		alert(msg);
		el = second;
	}
	if (msg){
		//alert(msg);
		el.focus();
		el.select();
		return false;
	}
}
//Check file extention
//extArray = new Array(".jpg", ".png", ".bmp"); //example file extentions
extArray = new Array(".csv");

function limitAttach(file){
    allowSubmit = false;
    file	= file.value;
	
    if (!file) return;
    while (file.indexOf("\\") != -1)
	file = file.slice(file.indexOf("\\") + 1);
    ext = file.slice(file.indexOf(".")).toLowerCase();
			
    for (var i = 0; i < extArray.length; i++){
	if (extArray[i] == ext) {
	    allowSubmit = true;
	    break;
	}
    }
    if (allowSubmit) {
	return true;
    }
    else{
	alert("Please only upload files that end in types:  "
	    + (extArray.join("  ")) + "\nPlease select a new "
	    + "file to upload and submit again.");
	return false;
    }
}


function popup_opener($url){
    popwindow = window.open ($url, "mypopup",
	"location=1,status=1,scrollbars=1,width=100,height=100");
    popwindow.moveTo(0,0);
}

function merchantDetail(id){
	if(id!=''){
		window.document.location='/merchants/merchantDetail/'+id;
	}
}

function showField(obj,val){
	if(obj.value==''){
		obj.value=val;
	}
}

function hideField(obj,val){
	if(obj.value==val){
		obj.value=''; 
	}
}

function showPassword(obj,id){
	if(obj.value==''){
		document.getElementById(id).style.display='none';
		document.getElementById(id+'Hide').style.display='';
	}
}

function hidePassword(obj,id){			
	document.getElementById(id+'Hide').style.display='none';
	document.getElementById(id).style.display='';
	document.getElementById(id).value='';
	document.getElementById(id).focus();
}

function goShopping(url){
	var newwin = window.open(url,'_blank');
	if (!newwin){
		alert('popups blocked');
		self.location.href = url;
	}else if (newwin.closed || (newwin == null) || (typeof(newwin) == "undefined")){
		alert('popups blocked');
		self.location.href = url;
	}
}

function showShop(name){
	window.status=name;
}

function hideShop(){
	window.status='';
}

function doAction(frmObject,id){
	if(checkSelect(frmObject,id)){
		frmObject.submit();
	}
}

function favoritesList(letter){
	if(letter!=''){
		window.document.location='/users/myfavorites/sel_letter:'+letter+'#addFavorite';
	}
}


function checkAllCheckboxes(fieldid,limit){
        //fieldid = fieldid + '[' + i + ']';
	for(i=1; i<limit; i++)
	{
                currentfieldid = fieldid + i;               
		document.getElementById(currentfieldid).checked = "checked";
	}
}

function uncheckAllCheckboxes(fieldid,limit){
    //fieldid = fieldid + '[' + i + ']';
    for(i=1; i<limit; i++)
    {
	currentfieldid = fieldid + i;
	document.getElementById(currentfieldid).checked = "";
    }
}