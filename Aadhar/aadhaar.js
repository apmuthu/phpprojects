// JavaScript Document
var d = [
    [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
    [1, 2, 3, 4, 0, 6, 7, 8, 9, 5],
    [2, 3, 4, 0, 1, 7, 8, 9, 5, 6],
    [3, 4, 0, 1, 2, 8, 9, 5, 6, 7],
    [4, 0, 1, 2, 3, 9, 5, 6, 7, 8],
    [5, 9, 8, 7, 6, 0, 4, 3, 2, 1],
    [6, 5, 9, 8, 7, 1, 0, 4, 3, 2],
    [7, 6, 5, 9, 8, 2, 1, 0, 4, 3],
    [8, 7, 6, 5, 9, 3, 2, 1, 0, 4],
    [9, 8, 7, 6, 5, 4, 3, 2, 1, 0]
];

// permutation table p
var p = [
    [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
    [1, 5, 7, 6, 2, 8, 3, 0, 9, 4],
    [5, 8, 0, 3, 7, 9, 6, 1, 4, 2],
    [8, 9, 1, 6, 0, 4, 3, 5, 2, 7],
    [9, 4, 5, 3, 1, 2, 6, 8, 7, 0],
    [4, 2, 8, 6, 5, 7, 3, 9, 0, 1],
    [2, 7, 9, 3, 8, 0, 6, 4, 1, 5],
    [7, 0, 4, 6, 9, 1, 3, 2, 5, 8]
];

// inverse table inv
var inv = [0, 4, 3, 2, 1, 5, 6, 7, 8, 9];
var msg='';
// converts string or number to an array and inverts it
function invArray(array)
 {

    if (Object.prototype.toString.call(array) === "[object Number]")
	 {
        array = String(array);
    }

    if (Object.prototype.toString.call(array) === "[object String]")
	 {
        array = array.split("").map(Number);
    }

    return array.reverse();

}

// generates checksum
function generate(array) {

    var c = 0;
    var invertedArray = invArray(array);
 
    for (var i = 0; i < invertedArray.length; i++) {
        c = d[c][p[((i + 1) % 8)][invertedArray[i]]];
    }
     myalert(inv[c]);
    return inv[c];
}

// validates checksum
function validate(array,index) {
	//generate(array);
	$('#msg').html('');
	if(array.length !=12)
	{
     
	 myalert('Please Enter 12 digit Aadhaar Number!!');
	 msg='Please Enter 12 digit Aadhaar Number!!';	
	 $('#msg').html('<font color="green">'+msg+'</font>');
	 $('.aadharno_validate'+index).css('border', 'solid 1px #ff944d');
	 $('.aadharno_validate'+index).css('background-color', '#ffe0cc');
	// $('.aadharno_validate'+index).focus();
	 return false;
	}
	else if(array=='333333333333' || array=='666666666666' || array=='999999999999' )
	{
		 myalert('Invalid Aadhaar Number!!');
		 $('.aadharno_validate'+index).val('');
		 $('#msg').html('<font color="green">'+msg+'</font>');
		 $('.aadharno_validate'+index).css('border', 'solid 1px #ff944d');
		 $('.aadharno_validate'+index).css('background-color', '#ffe0cc');
		// $('.aadharno_validate'+index).focus();
		 return false;
	}
    var c = 0;
    var invertedArray = invArray(array);
	//alert(invertedArray.length);
    for (var i = 0; i < invertedArray.length; i++) {
        c = d[c][p[(i % 8)][invertedArray[i]]];
		//alert(c);
    }
   if(c==0)
   {
	
	}
	else
	{
	 myalert("Invalid Aadhaar Number");
	 msg="Invalid Aadhaar Number!!!";
	 $('.aadharno_validate'+index).css('border', 'solid 1px #ff944d');
	 $('.aadharno_validate'+index).css('background-color', '#ffe0cc');
	 //$('.aadharno_validate'+index).focus();
	 $('.aadharno_validate'+index).val('');
	}
	//$('#msg').html('');
	//$('#msg').html('<font style="font-weight:bold;" color="green">'+msg+'</font>');
    
}