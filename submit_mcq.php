<?php 
	session_start();
	require "blockchain/blockchain.php";
    $jsondata = new Block_chain;

	$post['time'] = time();
	for($i = 1; $i <= 15; $i ++) {
		$post['q'.$i] = $_POST['q'.$i];
	}
	$post['created_by'] = $_SESSION['userdata']->id;
	$post['created_at'] = date("Y-m-d H:i:s");
	$jsondata->add_data('json/mcq.json',$post);

	header("Location: dashboard.php");
?>