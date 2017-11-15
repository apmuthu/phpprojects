function d2h(decimal)
	{
	var j=decimal;
    	var hexchars =  "0123456789ABCDEF";
    	var hv = "";
    	for (var i=0; i< 2; i++)
      	{
        	k = j & 15;
        	hv = hexchars.charAt(k) + hv;
        	j = j >> 4;
      	}
	return (hv);
	}

function h2d(hex)
	{
  	var j = hex.toUpperCase();
  	var d = 0;
  	var ch = ' ';
  	var hexchars =  "0123456789ABCDEF";
  	while (j.length < 4) j = 0 + j;
  	for (var i = 0; i < 4; i++)
    		{
      	ch = j.charAt(i);
      	d = d*16 + hexchars.indexOf(ch); 
    		}
    		return (d);
	}

function d2b(decimal)
	{		
	var bit8=0,bit7=0,bit6=0,bit5=0,bit4=0,bit3=0,bit2=0,bit1=0;				
	if (decimal & 128) { bit8 = 1 }		
	if (decimal & 64) { bit7 = 1 }		
	if (decimal & 32) { bit6 = 1 }		
	if (decimal & 16) { bit5 = 1 }		
	if (decimal & 8) { bit4 = 1 }		
	if (decimal & 4) { bit3 = 1 }		
	if (decimal & 2) { bit2 = 1 }		
	if (decimal & 1) { bit1 = 1 }				
	return (""+bit8+bit7+bit6+bit5+bit4+bit3+bit2+bit1);	
	}

function d2bits(decimal)
	{		
	var bits=0;				
	if (decimal & 128) { bits = bits + 1 }		
	if (decimal & 64) { bits = bits + 1 }		
	if (decimal & 32) { bits = bits + 1 }		
	if (decimal & 16) { bits = bits + 1 }		
	if (decimal & 8) { bits = bits + 1 }		
	if (decimal & 4) { bits = bits + 1 }		
	if (decimal & 2) { bits = bits + 1 }		
	if (decimal & 1) { bits = bits + 1 }				
	return (bits);	
	}

function snmcorrect(decimal)
	{
	snmcorr = decimal;
	if (decimal > 255) snmcorr = 255;
	if (decimal == 253) snmcorr = 254;
	if ((decimal > 248)  && (decimal < 252)) snmcorr = 252;
	if ((decimal > 240)  && (decimal < 248)) snmcorr = 248;
	if ((decimal > 224)  && (decimal < 240)) snmcorr = 240;
	if ((decimal > 192)  && (decimal < 224)) snmcorr = 224;
	if ((decimal > 128)  && (decimal < 192)) snmcorr = 192;
	if ((decimal > 0)  && (decimal < 128)) snmcorr = 128;
	if (decimal < 0) snmcorr = 0;
	return (snmcorr);
	}

function b2d(binary) {		
	var decimal = 0;				
	while (binary.length < 8)
		{			
		binary = "0" + binary;		
		}				
	if (binary.substring(7,8) == "1") { decimal++ }		
	if (binary.substring(6,7) == "1") { decimal = decimal + 2 }		
	if (binary.substring(5,6) == "1") { decimal = decimal + 4 }		
	if (binary.substring(4,5) == "1") { decimal = decimal + 8 }		
	if (binary.substring(3,4) == "1") { decimal = decimal + 16 }		
	if (binary.substring(2,3) == "1") { decimal = decimal + 32 }		
	if (binary.substring(1,2) == "1") { decimal = decimal + 64 }		
	if (binary.substring(0,1) == "1") { decimal = decimal + 128 }				
	return(decimal);	
	}		

function bits2d(binary) {		
	var decimal = 0;				
	if (binary > 0) { decimal = decimal + 128 }				
	if (binary > 1) { decimal = decimal + 64 }				
	if (binary > 2) { decimal = decimal + 32 }				
	if (binary > 3) { decimal = decimal + 16 }				
	if (binary > 4) { decimal = decimal + 8 }				
	if (binary > 5) { decimal = decimal + 4 }				
	if (binary > 6) { decimal = decimal + 2 }				
	if (binary > 7) { decimal = decimal + 1 }				
	return(decimal);	
	}		
