<?php 
	session_start();
	require "blockchain/blockchain.php";

	$post = $_POST;
	$flag = 1;

	$jsondata = new Block_chain;
	$response = $jsondata->read_data('json/user.json');
	if($response)
	{
		$found = 0;
		foreach($response as $key => $val)
		{
			if($val->phone == $jsondata->data_encryption($post['username']) && $val->password == $jsondata->data_encryption($post['password']))
			{
				$found = 1;
				$_SESSION['userdata'] = $val;
				break;			
			}
		}
		if($found == 1)
		{
			header('Location: dashboard.php');
		} else {
			$_SESSION['error'] = "Mobile No. or Password is wrong.";
			header('Location: index.php');
		}
	}
