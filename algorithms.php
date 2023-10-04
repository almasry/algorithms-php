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



-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA4mgRQbmZG6H0ud2VOtMG
8mnlSNXC+4STgVOZkmebyAutvlMF14xnzt1uhj/+qeyg5Ummp0Y6oSljF4HpCnsT
EVhyYQgyezhYv1OBvNnT9wSKVY3i1Q7NmQvRpLcBQJptCwLucJrRLXFya0pAtEpD
NAXoWAE/3csHmDLkMGPB8R8Q8eTggbVDO/aG0GkPokKq02e6Wz9Vm7Rcdr7hRkwC
mhhf8KXiEtfSW6liBIifGcEHv31Lt31pcVEVMerMKTFQFTz4J7tqkpgOesVrJu3p
MZPW+CcZclUTGLJj4HsQ9O1tS0uAhbm3bCrJosN5S6JKat3lYaDjrm9rcDr8bVTP
fwIDAQAB
-----END PUBLIC KEY-----


-----BEGIN PRIVATE KEY-----
MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDiaBFBuZkbofS5
3ZU60wbyaeVI1cL7hJOBU5mSZ5vIC62+UwXXjGfO3W6GP/6p7KDlSaanRjqhKWMX
gekKexMRWHJhCDJ7OFi/U4G82dP3BIpVjeLVDs2ZC9GktwFAmm0LAu5wmtEtcXJr
SkC0SkM0BehYAT/dyweYMuQwY8HxHxDx5OCBtUM79obQaQ+iQqrTZ7pbP1WbtFx2
vuFGTAKaGF/wpeIS19JbqWIEiJ8ZwQe/fUu3fWlxURUx6swpMVAVPPgnu2qSmA56
xWsm7ekxk9b4JxlyVRMYsmPgexD07W1LS4CFubdsKsmiw3lLokpq3eVhoOOub2tw
OvxtVM9/AgMBAAECggEBALBQdOfnPonbZTb9jYJi5q0PtKQ0/ARdaXW0ggsWrqVq
GuL1yr3itNDPdowL+CmigmYtJiBsO6pYDbg3ziEAWYgPhft0o8N7zPkqcgV86Wob
2hLoTPa48Xm3T4rjjZEe8b46iS+eETo/d+h/ycXdc1pnI1qtlmwF+aMYNsZMWbOI
k+Y/V2SkMmwCBNsWCVsOQojZ70VTkTJ+TMQEWsn99j3ELWVRR314OqhQu+2TGAbP
Ll/FiXO0oG1ZvvwShznLHeo1SkO/j5XOXLczAW2IpCTc51+KWZ+PA/SZQ45GFeAH
ACEUlSEfdgGT7DE5d+W2vake0bx4d8T+yXyC3OgO91ECgYEA9MxvAkgm5rSBAYjw
8D6ZxC/IWKGOPGG9+H64dJjqnhizifxhw3maadblObH7UCOjtXWKIOVudKisqTYV
r4QWKkYNfRvbuLOnw3jF0F8UUSTTZxKexEklmTuO3fLXaVnv0R5mpxgQKCJgbCx4
G6fSA7tws2Xlo60dXP9Gik6YKZcCgYEA7MQwhitpwnUmCILt1xVpnxxie3S6YWag
jlJ1F8Kb+RHcmephmW5PQmyz4m2sWCBEh8T0+M4a/mywTEYPq/1cPIKM67cCbwlH
WPgtt+Fvo2NtaqcXE4cCzmZemwCvzDD72osj8vx4Ek9nWdwhWz8R1TwaHIiZUNdo
yU9FWKOrtlkCgYAVW7jbxBvQyTLwRVhwPaYA3gJm6UGVtxlyEuxZD/Z4cMNJaMHG
4lc8oMlDLWo15cYk0OqKUDpA526ZHOTreWTNr2sB3WpgRRyAC4uG0KTfJ41iUteT
XKZxJici6kstH/GylypxrcHLHqS3C3I3R38lYDdHD77ndvU25fbrnkvcZQKBgQDk
vhZzSXX/3NZF2tiVt6Y3hmDPDVMTzubHGXru3aF63HrYaMyqQxxn/EU+ON8MtQAA
e5SA2/7QV4lr5zQ04a4+95HWGRVM2RYJKpxgznfgzqpjI9LzlrhrWBOGhP9SsvBf
j5XHp4sJhZVAB6BiW2iLLmm7r20P4UznUKKapGW84QKBgAK0gUM20XdF9apWN74q
OlYY/Bz5Q3+yvl+ZkTgTgwUjlmGKW3/6FPME7hvIdtgHIO0E3/7KjPXOl0DKOjhz
mqKY+1PQ0bO3iLn2VzUANkXFsMAN3UYho6A6ZRcpAVRsm+9ecc0l9lJ0tAqOT98s
OQ60DgD5StxcXNvpr0OONo8M
-----END PRIVATE KEY-----



    

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
