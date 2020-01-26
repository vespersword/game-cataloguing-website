<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="form.css">
</head>
<body bgcolor ="lightblue">
<div align=center>
<h1> Game Cataloguer Registration </h1>
<form name="reg" action="" method="post" onsubmit="form_verify()">
	<label>Username:</label> <input type="text" name="name"><br>
	<label>Password:</label> <input type="password" name="password"><br>
	<label>Re-enter your password:</label> <input type="password" name="repass"> <br>
	<label>Enter your e-mail id:</label> <input type="email" name="email"> <br>
	<input type="submit" name="submit"> <br>
	<input type="hidden" name="valid" value=0>
</form>
</div>
<a href="index.php">Click here to go to login page. </a>
</body>
</html>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'C:\xampp\composer\vendor\autoload.php';
include("config.php");
if(isset($_POST['submit'])){
$name = $_POST['name'];
$password = $_POST['password'];
$email = $_POST['email'];
$valid = $_POST['valid'];

if($valid==1){

$sql = "INSERT INTO users (username, password, email)
VALUES ('$name', '$password', '$email')";

$result = mysqli_query($db,$sql);
if ($result) {
    echo "Registered successfully. An email has been sent to the provided address.";
} 

$sql1 = "INSERT INTO lists (username, list)
VALUES ('$name','')";

$result = mysqli_query($db,$sql1) or die(mysqli_error($db));
if ($result) {
    echo "Added to lists.";
} 

/*
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "mymail.@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "password";
//Set who the message is to be sent from
$mail->setFrom('mymail@gmail.com', 'First Last');
//Set an alternative reply-to address
#$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress($email, 'John Doe');
//Set the subject line
$mail->Subject = 'Welcome to Game Cataloguer';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
#$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
//Replace the plain text body with one created manually
#$mail->AltBody = 'Welcome to Game Cataloguer website!.';
$mail->Body = "Welcome to Game Cataloguer website!";
//Attach an image file
#$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}
*/

}
}

?>

<script> 
function form_verify()                                    
{ 
    var name = document.forms["reg"]["name"];               
    var email = document.forms["reg"]["email"];
    var repass =  document.forms["reg"]["repass"];  
    var password = document.forms["reg"]["password"];
    var valid = document.forms["reg"]["valid"];    
   
    if (name.value == "")                                  
    { 
        window.alert("Please enter your name."); 
        name.focus(); 
        return false;
    }

    if (password.value == "")                        
    { 
        window.alert("Please enter a password"); 
        password.focus(); 
        return false; 
    } 
       
    if (email.value == "")                                   
    { 
        window.alert("Please enter a valid e-mail address."); 
        email.focus(); 
        return false; 
    } 
   
    if (email.value.indexOf("@", 0) < 0)                 
    { 
        window.alert("Please enter a valid e-mail address."); 
        email.focus(); 
        return false; 
    } 
   
    if (email.value.indexOf(".", 0) < 0)                 
    { 
        window.alert("Please enter a valid e-mail address."); 
        email.focus(); 
        return false; 
    } 

    if (password.value !== repass.value)                        
    { 
        window.alert("Passwords don't match."); 
        password.focus(); 
        return false; 
    } 
    valid.value = 1;
    return true; 
}
</script> 