<?php

require_once ("index.php");
require_once ("config.php");


if(isset($_POST['SingUp'])){

    /* Variables */
    $name = $_POST['name'];
    $lastName = $_POST['last-name'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email-user'];
    $phoneNumber = $_POST['phone-number'];
    $user = $_POST['user'];
    $UserPassword = $_POST['UserPassword'];

    $fullname = $name . " " . $lastName;

    
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

    function PasswordEncryption($UserPassword){
        // Encryp data
        $PasswordEncrypt = $UserPassword;
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

    $sql = "INSERT INTO users (Users, UserPasswords, fullname, email, phone_number, birthday) VALUES(?, ?, ?, ?, ?, ?)";
    $stmtinsert = $db->prepare($sql);
    $result = $stmtinsert->execute([$UserDbEncrypt, $PasswordDbEncrypt, $fullname, $email, $phoneNumber, $birthday]);
    if($result)
    {
        echo "Agregado Exitosamente";
    }else{
        echo "Error";
    }
}

?>