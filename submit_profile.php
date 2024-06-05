<?php
	session_start();
	require "blockchain/blockchain.php";
	$jsondata = new Block_chain;

	$response = $jsondata->read_data('json/user.json');
	if($response)
	{
		$post = $_POST;
		$flag = 1;
		foreach($response as $key => $val)
		{
			if($val->id == $post['pid'])
			{
				$val->name = $jsondata->data_encryption($post['name']);
				$val->email = $jsondata->data_encryption($post['email']);
				$val->phone = $jsondata->data_encryption($post['phone']);
				$val->experience = $jsondata->data_encryption($post['experience']);
				$val->package = $jsondata->data_encryption($post['package']);
				$val->ssc = $jsondata->data_encryption($post['ssc']);
				$val->linkedin = $jsondata->data_encryption($post['linkedin']);
				$val->graduation = $jsondata->data_encryption($post['graduation']);
				$val->post_graduation = $jsondata->data_encryption($post['post_graduation']);
				$val->no_project = $jsondata->data_encryption($post['no_project']);
				$val->updated_by = $_SESSION['userdata']->id;
				$val->updated_at = date('Y-m-d H:i:s');
			}
		}
		$jsondata->update_data('json/user.json',$response);
	}
	header("Location: profile.php");
?>