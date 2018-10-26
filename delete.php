<?php
	include "./dbconfig.php";
	session_start();
	if(isset($_SESSION['id'])){
	header('Content-Type: text/html; charset=utf-8');

	$bno = $_GET['idx'];
	$sql = mq("delete from board where idx='$bno';");
	echo "<script>alert('삭제되었습니다.');</script>";
	}else{
	header('Content-Type: text/html; charset=utf-8');
echo "<script>alert('잘못된 접근입니다.'); location.href='./board.php'; </script>";
	} 
?>
<meta http-equiv="refresh" content="0 url=./board.php" />