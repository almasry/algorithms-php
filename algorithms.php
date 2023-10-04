<?php

// openssl genpkey -algorithm RSA -out private_key.pem
// openssl rsa -pubout -in private_key.pem -out public_key.pem

    
function encryptRSA($plaintext, $public_key_path) {
    $publicKey = openssl_pkey_get_public(file_get_contents($public_key_path));
    $ciphertext = null;
    
    openssl_public_encrypt($plaintext, $ciphertext, $publicKey);
    
    // Base64 encode to represent binary data as a string
    return base64_encode($ciphertext);
}

function decryptRSA($ciphertext_base64, $private_key_path) {
    $privateKey = openssl_pkey_get_private(file_get_contents($private_key_path));
    $ciphertext = base64_decode($ciphertext_base64);
    $plaintext = null;
    
    openssl_private_decrypt($ciphertext, $plaintext, $privateKey);
    
    return $plaintext;
}

// Example usage
$public_key_path = 'path/to/public_key.pem';
$private_key_path = 'path/to/private_key.pem';
$plaintext = 'Hello, RSA!';

echo "Original Message: $plaintext\n";

$ciphertext = encryptRSA($plaintext, $public_key_path);
echo "Encrypted Message: $ciphertext\n";

$decrypted = decryptRSA($ciphertext, $private_key_path);
echo "Decrypted Message: $decrypted\n";




?>
