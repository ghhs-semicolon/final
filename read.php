<?php
    include('./dbconfig.php');
    $bno = $_GET['idx'];
	$sql = mq("select * from board where idx='".$bno."'");
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
        <div class="one fields">
            <div class="ui attached message">
            <?php echo $board['content'];?>
            </div>
        </div>
        <button class="ui blue submit button" type="submit" onclick="window.location.href='edit.php?idx=<?php echo $board['idx']; ?>'">수정하기</button>
        <button class="ui red submit button" type="submit" onclick="window.location.href='delete.php?idx=<?php echo $board['idx']; ?>'">삭제하기</button>
    </div>
  </div>
  <script src='https://code.jquery.com/jquery-3.3.1.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js'></script>
</body>
</html>