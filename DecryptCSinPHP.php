<?php

/*
// C# program for encryption / decryption (and decrypt in php below)
// http://stackoverflow.com/questions/17780201/how-to-decrypt-c-sharp-code-in-php

public string Encrypt(string textToBeEncrypted, string Password) 
{ 

    RijndaelManaged RijndaelCipher = new RijndaelManaged(); 
    ICryptoTransform Encryptor = null; 
    byte[] plainText = null; 
    try 
    { 
        byte[] Salt = Encoding.ASCII.GetBytes(Password.Length.ToString()); 
        PasswordDeriveBytes SecretKey = new PasswordDeriveBytes(Password, Salt); 
        //Creates a symmetric encryptor object. 
        Encryptor = RijndaelCipher.CreateEncryptor(SecretKey.GetBytes(32), SecretKey.GetBytes(16)); 
        plainText = Encoding.Unicode.GetBytes(textToBeEncrypted); 

    } 
    catch (Exception ex) 
    { 
        string str = "Method Name: " + MethodBase.GetCurrentMethod().Name + " | Description: " + ex.Message + ex.InnerException; 
        log.Error(str); 

    } 
    return Convert.ToBase64String(Encryptor.TransformFinalBlock(plainText, 0, plainText.Length)); 

}

public string Decrypt(string TextToBeDecrypted, string Password) { 
    RijndaelManaged RijndaelCipher = new RijndaelManaged(); 
    string DecryptedData; 
    byte[] EncryptedData = Convert.FromBase64String(TextToBeDecrypted); 
    byte[] Salt = Encoding.ASCII.GetBytes(Password.Length.ToString()); 

//Making of the key for decryption 
    PasswordDeriveBytes SecretKey = new PasswordDeriveBytes(Password, Salt); 

//Creates a symmetric Rijndael decryptor object. 
    ICryptoTransform Decryptor = RijndaelCipher.CreateDecryptor(SecretKey.GetBytes(32),SecretKey.GetBytes(16)); 
    byte[] plainText = Decryptor.TransformFinalBlock(EncryptedData, 0, EncryptedData.Length); 

//Converting to string 
    DecryptedData = Encoding.Unicode.GetString(plainText); 
    return DecryptedData; 
} 

*/

/*
You need to have the same mode for encryption and decrytion.
	In php code you are using ECB mode for decryption.
	Check if you are using the same ECB mode in C#.
Generate the key and iv in the c# for encryption and use the same values for decryption.
	Dont generate key or iv in php decryption code.
$key contains alphabets upto 12 chars ie.ABCDEFGPQRUV 
*/

function decryptData($value){
    $key = "same key used in above c# code";
    $crypttext = base64_decode($value);
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $crypttext, MCRYPT_MODE_ECB, $iv);
    return trim($decrypttext); 
}

?>

