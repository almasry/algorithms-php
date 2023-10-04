<?php
// Equivalent PHP code for the Encrypt function in the provided Golang code.

function encrypt($plaintext, $key) {
    // Hash key to ensure it is 256 bits (32 bytes)
    $key = hash('sha256', $key, true);

    // Generate a random initialization vector (IV) for AES-256 CBC mode.
    $iv_size = openssl_cipher_iv_length('aes-256-cbc');
    $iv = openssl_random_pseudo_bytes($iv_size);

    // Encrypt the plaintext.
    $ciphertext = openssl_encrypt($plaintext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);

    // Concatenate the IV and the ciphertext and encode them in base64 to create the final encrypted string.
    $encryptedText = base64_encode($iv . $ciphertext);
    
    return $encryptedText;
}


function decrypt($encryptedText, $key) {
    // Hash key to ensure it is 256 bits (32 bytes)
    $key = hash('sha256', $key, true);

    // Decode the base64 encoded encrypted text
    $encryptedData = base64_decode($encryptedText);
    
    // Extract the IV from the concatenated IV and ciphertext
    $iv_size = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($encryptedData, 0, $iv_size);
    
    // Extract the actual ciphertext from the concatenated IV and ciphertext
    $ciphertext = substr($encryptedData, $iv_size);

    // Decrypt the ciphertext
    $plaintext = openssl_decrypt($ciphertext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    
    return $plaintext;
}

?>
