<?php
    include('./dbconfig.php');
    session_start();
	if(isset($_SESSION['id'])) {
		echo("<script>window.location.href='#';</script>");
	}else{
    die("<script>window.location.href='./index.php';</script>");
  }
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
      <form method="post" action="process.php">
        <input name="cmd" value="0" type="hidden">
        <button class="ui green submit button" style="float:right;" name="submit" type="submit">로그아웃</button>
    </form>
    </div>

    <div class="ui raised segment">
        <div class="ui attached message">
            <div class="header">
                세미콜론 게시판
            </div>
        </div>
        <table class="ui unstackable table">
            <thead>
                <tr><th>제목</th>
                <th>작성자</th>
                <th>작성일</th>
            </tr></thead>
            <?php
                $sql = mq("select * from board order by idx desc limit 0,5");  
                while($board = $sql->fetch_array()){
                    $title=$board['content']; 
                    if(strlen($title)>30){ 
                        $title=str_replace($title,mb_substr($title,0,30,"utf-8")."...",$title);
                    }
            ?>
            <tbody>
                <tr>
                    <td data-label=""><a href="read.php?idx=<?php echo $board['idx']; ?>"><?php echo $title;?></a></td>
                    <td data-label=""><?php echo $board['id'];?></td>
                    <td data-label=""><?php echo $board['date']?></td>
                </tr>
            </tbody>
            <?php } ?>
        </table>
    </div>
    <button class="ui blue submit button" type="submit" onclick="window.location.href='write.php'">글쓰기</button>
  </div>
  <script src='https://code.jquery.com/jquery-3.3.1.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js'></script>
</body>
</html>