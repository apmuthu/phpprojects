function parse_webkit_version(version) {
  var bits = version.split(".");
  var is_nightly = (version[version.length - 1] == "+");
  if (is_nightly) {
    var minor = "+";
  } else {
    var minor = parseInt(bits[1]);
    // If minor is Not a Number (NaN) return an empty string
    if (isNaN(minor)) {
      minor = "";
    }
  }
  return {major: parseInt(bits[0]), minor: minor, is_nightly: is_nightly};
}

function get_webkit_version() {
  var regex = new RegExp("\\(.*\\) AppleWebKit/(.*) \\((.*)");
  var matches = regex.exec(navigator.userAgent);
  if (matches) {
    var webkit_version = parse_webkit_version(matches[1]);
    return (webkit_version['major'] < 312);
  } else {
	return false;
  }
}


if (get_webkit_version()){
	document.write('<blockquote><p><font size="3" color="#FF0000"><b>WARNING!!! You are using and old version of Safari.</b></font><br><font size="2" color="#000080">Versions of Safari prior to 1.3 have JavaScript bugs which will prevent you from getting accurate results. Please upgrade your Mac to the latest version or use a different browser, such as IE or FireFox, while using this site.</font></p></blockquote>');
}