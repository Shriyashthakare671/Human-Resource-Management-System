<?php 
	session_start();
	require "blockchain/blockchain.php";
	$jsondata = new Block_chain;

	$get = $_GET;
	if(isset($get['action']) && $get['action'] == "delete")
	{
		$patients = $jsondata->read_data('json/past.json');
		if($patients)
		{
			$newdata = [];
			foreach($patients as $key => $val)
			{
				if($val->id != $_GET['iid'])
				{
					$tmp['id'] = $val->id;
					$tmp['cname'] = $val->cname;
					$tmp['sdate'] = $val->sdate;
					$tmp['edate'] = $val->edate;
					$tmp['experience'] = $val->experience;
					$tmp['package'] = $val->package;
					$tmp['created_by'] = $val->created_by;
					$tmp['updated_by'] = $val->updated_by;
					$tmp['created_at'] = $val->created_at;
					$tmp['updated_at'] = $val->updated_at;
					$newdata[] = $tmp;
				}
			}
		}
		$jsondata->remove_data('json/past.json',$newdata);
	} else {
		$post = $_POST;
		if($post['form_action'] == "add")
		{
			$postdata['id'] = time();
			$postdata['cname'] = $jsondata->data_encryption($post['cname']);
			$postdata['sdate'] = $jsondata->data_encryption($post['sdate']);
			$postdata['edate'] = $jsondata->data_encryption($post['edate']);
			$postdata['experience'] = $jsondata->data_encryption($post['experience']);
			$postdata['package'] = $jsondata->data_encryption($post['package']);
			$postdata['created_by'] = $_SESSION['userdata']->id;
			$postdata['updated_by'] = $_SESSION['userdata']->id;
			$postdata['created_at'] = date("Y-m-d H:i:s");
			$postdata['updated_at'] = date("Y-m-d H:i:s");
			$jsondata->add_data('json/past.json',$postdata);
		} else {
			$response = $jsondata->read_data('json/past.json');
			if($response)
			{
				$flag = 1;
				foreach($response as $key => $val)
				{
					if($val->id == $post['pid'])
					{
						$val->cname = $jsondata->data_encryption($post['cname']);
						$val->sdate = $jsondata->data_encryption($post['sdate']);
						$val->edate = $jsondata->data_encryption($post['edate']);
						$val->experience = $jsondata->data_encryption($post['experience']);
						$val->package = $jsondata->data_encryption($post['package']);
						$val->updated_by = $_SESSION['userdata']->id;
						$val->updated_at = date('Y-m-d H:i:s');
					}
				}
				$jsondata->update_data('json/past.json',$response);
			}
		}
	}
	header("Location: past_companies.php");
