<?php 
	session_start();
	require "blockchain/blockchain.php";
	$jsondata = new Block_chain;

	$users = $jsondata->read_data("json/user.json");
	$inteview = $jsondata->read_row_data("json/interview.json",$_GET["iid"]);
	$to = "";
	if($users) {
		foreach($users as $user) {
			$to .= $jsondata->data_decryption($user->email).",";
		}
	}
	$to = substr($to,0,strlen($to)-1);
	
	$subject = "Interview";
	    
	$message = "<h1>Inteview Information</h1>";
	$message .= "<p>Company Name : ".$jsondata->data_decryption($inteview->cname)."</p>";
	$message .= "<p>Position : ".$jsondata->data_decryption($inteview->position)."</p>";
	$message .= "<p>Package : ".$jsondata->data_decryption($inteview->package)."</p>";
	     
	$header = "From: HR info@gstempire.com \r\n";
	// $header .= "Cc:admission@gmail.com \r\n";
	$header .= "MIME-Version: 1.0\r\n";
	$header .= "Content-type: text/html\r\n";
	$retval = mail ($to,$subject,$message,$header);

	$_SESSION['success'] = "Email sent successfully.";
	header("Location: interviews.php");
?>