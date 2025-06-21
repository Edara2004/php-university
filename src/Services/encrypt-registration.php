<?php

require '../Controllers/registration.php';
require '../Controllers/user.php';

/* Functions */
function UserEncryption($user){
    // Encryp data
    $UserEncrypt = $user;
    // Store the cipher method
    $ciphering = "AES-128-CTR";
    
    // Use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    
    // Non-NULL Initialization Vector for encryption
    $encryption_iv = '1234567891011121';
    
    // Store the encryption key
    $encryption_key = "quiz-data";
    
    // Use openssl_encrypt() function to encrypt the data
    $encryption = openssl_encrypt($UserEncrypt, $ciphering,
                $encryption_key, $options, $encryption_iv);
    
    return $encryption;
}

/* Initialition of function for user Encryption */
$UserDbEncrypt=UserEncryption($user);

function PasswordEncryption($password){
    // Encryp data
    $PasswordEncrypt = $password;
    // Store the cipher method
    $ciphering = "AES-128-CTR";
    
    // Use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    
    // Non-NULL Initialization Vector for encryption
    $encryption_iv = '1234567891011121';
    
    // Store the encryption key
    $encryption_key = "quiz-data";
    
    // Use openssl_encrypt() function to encrypt the data
    $PasswordsEncryption = openssl_encrypt($PasswordEncrypt, $ciphering,
                $encryption_key, $options, $encryption_iv);
    
    return $PasswordsEncryption;
}

/* Initialition of function for Password Encryption */
$PasswordDbEncrypt=PasswordEncryption($UserPassword);

?>
