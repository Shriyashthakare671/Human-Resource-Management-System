<?php 
	session_start();
	require "blockchain/blockchain.php";
	$jsondata = new Block_chain;

	$get = $_GET;
	if(isset($get['action']) && $get['action'] == "delete")
	{
		$patients = $jsondata->read_data('json/user.json');
		if($patients)
		{
			$newdata = [];
			foreach($patients as $key => $val)
			{
				if($val->id != $_GET['pid'])
				{
					$tmp['id'] = $val->id;
					$tmp['name'] = $val->name;
					$tmp['phone'] = $val->phone;
					$tmp['email'] = $val->email;
					$tmp['password'] = $val->password;
					$tmp['usertype'] = $val->usertype;
					$tmp['state'] = $val->state;
					$tmp['created_by'] = $val->created_by;
					$tmp['updated_by'] = $val->updated_by;
					$tmp['created_at'] = $val->created_at;
					$tmp['updated_at'] = $val->updated_at;
					$newdata[] = $tmp;
				}
			}
		}
		$jsondata->remove_data('json/user.json',$newdata);
		echo json_encode(array("status" => 1));
		exit;
	} else {
		$post = $_POST;
		// $upload_dir = 'assets/uploads/'.basename($_FILES["document_file"]["name"]);
		// $postdata['document_file'] = $_FILES['document_file']['name'];
		// move_uploaded_file($_FILES["document_file"]["tmp_name"], $upload_dir);

		if($post['form_action'] == "add")
		{
			$postdata['id'] = time();
			$postdata['name'] = $jsondata->data_encryption($post['name']);
			$postdata['phone'] = $jsondata->data_encryption($post['phone']);
			$postdata['email'] = $jsondata->data_encryption($post['email']);
			$postdata['password'] = $jsondata->data_encryption($post['password']);
			$postdata['usertype'] = $jsondata->data_encryption(2);
			$postdata['state'] = $jsondata->data_encryption($post['state']);
			$postdata['created_by'] = $_SESSION['userdata']->id;
			$postdata['updated_by'] = $_SESSION['userdata']->id;
			$postdata['created_at'] = date("Y-m-d H:i:s");
			$postdata['updated_at'] = date("Y-m-d H:i:s");
			$jsondata->add_data('json/user.json',$postdata);
		} else {
			$response = $jsondata->read_data('json/user.json');
			if($response)
			{
				$flag = 1;
				foreach($response as $key => $val)
				{
					if($val->id == $post['pid'])
					{
						$val->name = $jsondata->data_encryption($post['name']);
						$val->email = $jsondata->data_encryption($post['email']);
						$val->phone = $jsondata->data_encryption($post['phone']);
						$val->password = $jsondata->data_encryption($post['password']);
						$val->state = $jsondata->data_encryption($post['state']);
						$val->updated_by = $_SESSION['userdata']->id;
						$val->updated_at = date('Y-m-d H:i:s');
					}
				}
				$jsondata->update_data('json/user.json',$response);
			}
		}
		header("Location: users.php");
	}
