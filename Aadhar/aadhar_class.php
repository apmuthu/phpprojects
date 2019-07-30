<?php
// http://codes.tipsfusion.com/php/adhar-number-validation-by-php/

error_reporting(0);

class Adhar  {

	public $dihedral = array(
		array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9),
		array(1, 2, 3, 4, 0, 6, 7, 8, 9, 5),
		array(2, 3, 4, 0, 1, 7, 8, 9, 5, 6),
		array(3, 4, 0, 1, 2, 8, 9, 5, 6, 7),
		array(4, 0, 1, 2, 3, 9, 5, 6, 7, 8),
		array(5, 9, 8, 7, 6, 0, 4, 3, 2, 1),
		array(6, 5, 9, 8, 7, 1, 0, 4, 3, 2),
		array(7, 6, 5, 9, 8, 2, 1, 0, 4, 3),
		array(8, 7, 6, 5, 9, 3, 2, 1, 0, 4),
		array(9, 8, 7, 6, 5, 4, 3, 2, 1, 0)
	);

	public $permutation = array(
		array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9),
		array(1, 5, 7, 6, 2, 8, 3, 0, 9, 4),
		array(5, 8, 0, 3, 7, 9, 6, 1, 4, 2),
		array(8, 9, 1, 6, 0, 4, 3, 5, 2, 7),
		array(9, 4, 5, 3, 1, 2, 6, 8, 7, 0),
		array(4, 2, 8, 6, 5, 7, 3, 9, 0, 1),
		array(2, 7, 9, 3, 8, 0, 6, 4, 1, 5),
		array(7, 0, 4, 6, 9, 1, 3, 2, 5, 8)
	);

	public $inverse = array(0, 4, 3, 2, 1, 5, 6, 7, 8, 9);

	//for check aadhar function
	public function isAadharValid($num) {
		settype($num, "string");
		$expectedDigit = substr($num, -1);
		$actualDigit = $this->CheckSumAadharDigit(substr($num, 0, -1));
		return ($expectedDigit == $actualDigit) ? $expectedDigit == $actualDigit : 0;
	}

	public function CheckSumAadharDigit($partial) {
		settype($partial, "string");
		$partial = strrev($partial);
		$digitIndex = 0;
		for ($i = 0; $i < strlen($partial); $i++) {
			$digitIndex = $this->dihedral[$digitIndex][$this->permutation[($i + 1) % 8][$partial[$i]]];
		}
		return $this->inverse[$digitIndex];
	}

	public function check_adhar($AadharNo) {
		$result= $this->isAadharValid($AadharNo);
		if($result ==1)
		{
			return 1;
		} else {
			return 0;
		}
	}
}

$adhar= new Adhar();
$chk=false;

$adharData=$adhar->check_adhar($_REQUEST['aadhaarNumber']);
if ($adharData==0) {
	echo "Kindly Fill The Corect Aadhar Number";
} else {
	$chk = true;
	echo $_REQUEST['aadhaarNumber'] . " is Okay";
}

?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	Aadhar <input type="text" name="aadhaarNumber" maxlength="12"><br>
	<input type="submit" name="submit" value="Submit">
</form>
