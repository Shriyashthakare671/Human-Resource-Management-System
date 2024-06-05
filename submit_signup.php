<?php 
	session_start();
	require "blockchain/blockchain.php";
	require "blockchain/new_blockchain.php";

	$post = $_POST;
	$is_phone_exist = 0;
	$is_email_exist = 0;
	
	$jsondata = new Block_chain;
	$response = $jsondata->read_data('json/user.json');
	if($response)
	{
		foreach($response as $key => $val)
		{
			if($val->email == $jsondata->data_encryption($post['email']))
				$is_email_exist = 1;
			
			if($val->phone == $jsondata->data_encryption($post['phone']))
				$is_phone_exist = 1;
		}
	}
	if($is_email_exist == 0 && $is_phone_exist == 0)
	{
		$resume = "";
		$upload_dir = 'assets/uploads/'.basename($_FILES["resume"]["name"]);
		$resume = $_FILES['resume']['name'];
		move_uploaded_file($_FILES["resume"]["tmp_name"], $upload_dir);

		$postdata['id'] = time();
		$postdata['hospital_name'] = $jsondata->data_encryption($post['hospital_name']);
		$postdata['name'] = $jsondata->data_encryption($post['name']);
		$postdata['email'] = $jsondata->data_encryption($post['email']);
		$postdata['phone'] = $jsondata->data_encryption($post['phone']);
		$postdata['password'] = $jsondata->data_encryption($post['password']);
		$postdata['resume'] = $resume;
		$postdata['usertype'] = $jsondata->data_encryption(2);
		$postdata['created_at'] = date("Y-m-d H:i:s");
		$postdata['updated_at'] = date("Y-m-d H:i:s");

		$testCoin = new BlockChain();
		$testCoin->push(new Block(1, time(), json_encode($postdata)));
		$postdata['jsondata'] = isset($testCoin->chain[1]) ? json_encode($testCoin->chain[1]) : '';
		$response = $jsondata->add_data('json/user.json',$postdata);

		header("Location: index.php");	
	} else if($is_email_exist == 1 && $is_phone_exist == 1) {
		$_SESSION['error'] = "Mobile No. & Email are already used.";
		header("Location: signup.php");	
	} else if($is_email_exist == 1 && $is_phone_exist == 0) {
		$_SESSION['error'] = "Email is already used.";
		header("Location: signup.php");	
	} else {
		$_SESSION['error'] = "Mobile No. is already used.";
		header("Location: signup.php");	
	}
