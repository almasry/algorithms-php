<?php
// Equivalent PHP code for the Encrypt function in the provided Golang code.

function encrypt($text, $key) {
    // Hash key to ensure it is 256 bits
    $key = hash('sha256', $key, true);

    // Generate a random initialization vector (IV) for AES-256 CBC mode.
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

    // Encrypt the plaintext.
    $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $text, MCRYPT_MODE_CBC, $iv);
    
    // Concatenate the IV and the ciphertext and encode them in base64 to create the final encrypted string.
    $encryptedText = base64_encode($iv . $ciphertext);
    
    return $encryptedText;
}

function decrypt($encryptedText, $key) {
    // Hash key to ensure it is 256 bits
    $key = hash('sha256', $key, true);
    
    // Decode the base64 encoded encrypted text
    $encryptedData = base64_decode($encryptedText);
    
    // Extract the IV from the concatenated IV and ciphertext
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
    $iv = substr($encryptedData, 0, $iv_size);
    
    // Extract the actual ciphertext from the concatenated IV and ciphertext
    $ciphertext = substr($encryptedData, $iv_size);

    // Decrypt the ciphertext
    $plaintext = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $ciphertext, MCRYPT_MODE_CBC, $iv);
    
    return rtrim($plaintext, "\0"); // remove null padding
}




$plaintext = "This is a secret message!";
$key = "ThisIsASecretKey1234567890123456";  // Ensure key is the right size

$encryptedText = encrypt($plaintext, $key);
echo "Encrypted: " . $encryptedText . "\n";

$decryptedText = decrypt($encryptedText, $key);
echo "Decrypted: " . $decryptedText . "\n";

// Basic check to ensure the original and decrypted message are the same
if ($plaintext === $decryptedText) {
    echo "Success: Original and decrypted messages match.\n";
} else {
    echo "Error: Messages do not match.\n";
}


?>
