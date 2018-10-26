<?php
    include('dbconfig.php');
    session_start();
	if(isset($_SESSION['id'])) {
		echo("<script>window.location.href='#';</script>");
	}else{
    die("<script>window.location.href='index.php';</script>");
  }
?>
<?php
    header('Content-Type: text/html; charset=utf-8');
    if(isset($_SESSION['id'])){

	$bno = $_GET['idx'];
	$sql = mq("select * from board where idx='$bno';");
	$board = $sql->fetch_array();
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>세미콜론 웹 개발 프로젝트</title>
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.css'>
</head>
<body>
  <div class="ui container" id="container">
    <div class="ui basic segment" id="header">
      <h1 class="ui icon header" style="text-align: left; margin-top: 50px;">
        세미콜론 웹 개발 프로젝트
      </h1>
      <p>
        <strong style="color:#EC655A;">일년동안 수고했어!</strong>
      </p>
    </div>

    <div class="ui raised segment">
        <div class="ui attached message">
            <div class="header">
                세미콜론 게시판
            </div>
            <p>수정하기</p>
        </div>
        <form class="ui form attached fluid segment" method="post" action="process.php">
        <div class="one field">
            <div class="field">  
            <textarea placeholder="내용" type="text" name="content"><?php echo $board['content'];?></textarea>
            </div>
        </div>
        <input name="cmd" value="4" type="hidden"/>
        <button class="ui blue submit button" type="submit" name="submit">수정하기</button>
        </form>
    </div>
  </div>
  <script src='https://code.jquery.com/jquery-3.3.1.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js'></script>
</body>
</html>

<?php
}else{
echo "<script>alert('잘못된 접근입니다.'); location.href='board.php'; </script>";
    }
?> 