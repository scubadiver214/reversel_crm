<?php
    
    $message = $_POST['message'];
    $subject = $_POST['subject'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $error = '';

    if (!preg_match("/\S+/",$name)){
        $error.= "Name is required. Please try again. \n" ;
    }

    if (!preg_match("/\S+/",$message)) {
        $error.= "A message is required. Please try again. \n";
    }

    if (!preg_match("/\S+/",$subject)) {
        $error.= "Subject is required. Please try again. \n";
    }

    if (!preg_match("/^\S+@[A-Za-z0-9_.-]+\.[A-Za-z]{2,6}$/",$email)){
        $error.= "Email Address is incorrect. Please try again. \n";
    }

    if(!empty($error)) {
        echo $error;
    }

    $myemail = "allison@reverselivetransfers.com";

    $emess = "Name: ".$name."\n\n";

    $emess.= "Subject: ".$subject."\n\n";

    $emess.= "Comments: ".$message."\n\n";

    $emess.= "Email Address: ".$email."\n\n";

    $subj = "An Email from ".$name."";

    $mailsend = mail("$myemail","$subj","$emess","$ehead");

    ob_clean();
    if( $mailsend == true ) {
        echo "OK";
    } else { 
        echo "Email could not be sent.";
    }

?>





