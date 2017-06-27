<?php

session_name('wmd');session_start();
require('../include/connect.php');
$empty = true;

if(!empty($_POST)){
	
	$empty = null;
	$post = array_map('trim',array_map('strip_tags',$_POST));
	$error = [];
	
	
}