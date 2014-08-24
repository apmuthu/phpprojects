function SetCookieValues(name, value) 
	{
	var expDate = new Date(); 		// The expDate is the date when the cookie should expire, we will keep it for a year
	expDate.setTime( expDate.getTime() + (365 * 24 * 60 * 60 * 1000) ); 
		
	SetCookie( name, value, expDate); 	
	}

function getCookieVal(offset) 
	{
	var endstr = document.cookie.indexOf (";", offset);
	if (endstr == -1) 
		{
		endstr = document.cookie.length;
		}
		cookieval = unescape(document.cookie.substring(offset, endstr));
	return unescape(document.cookie.substring(offset, endstr));
	}
    
function GetCookie(name) 
	{
      	var arg = name + "=";
      	var alen = arg.length;
      	var clen = document.cookie.length;
      	var i = 0;
      	while (i < clen)
		{
        	var j = i + alen;
        	if (document.cookie.substring(i, j) == arg)
          		return getCookieVal (j);
        	i = document.cookie.indexOf(" ", i) + 1;
        	if (i == 0) break; 
	      	}
	return null;
	}
    
function SetCookie(name, value, expDate)
	{
	var argv = SetCookie.arguments;
	var argc = SetCookie.arguments.length;
	document.cookie = name + "=" + escape (value) + "; expires=" + expDate + "; path=/" + "; domain=subnetmask.info;"
	}
   
function DeleteCookie(name)
	{
	var exp = new Date();
	exp.setTime (exp.getTime() - 1);  // This cookie is history
	var cval = GetCookie (name);
	document.cookie = name + "=" + cval + "; expires=" + exp.toGMTString();
	}

