<?php 

	session_start();

	require "blockchain/blockchain.php";

	$jsondata = new Block_chain;



	$user = $jsondata->read_row_data("json/user.json",$_GET["eid"]);

	$to = $jsondata->data_decryption($user->email);

	

	$subject = "Promotion Email";

	$message = "<h1>Promotion</h1>";

    $message .= "You are promoted";

	     

	$header = "From: HR info@gstempire.com \r\n";

	// $header .= "Cc:admission@gmail.com \r\n";

	$header .= "MIME-Version: 1.0\r\n";

	$header .= "Content-type: text/html\r\n";

	$retval = mail ($to,$subject,$message,$header);



	$_SESSION['success'] = "Email sent successfully.";

	header("Location: users.php");

?>