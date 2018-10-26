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
            <p>들어가려면 가입하자!</p>
        </div>
        <form class="ui form attached fluid segment" method="post" action="process.php">
        <div class="two fields">
            <div class="field">  
            <input placeholder="아이디" type="text" name="id">
            </div>

            <div class="field">
            <input placeholder="비밀번호" type="password" name="pw">
            </div>
        </div>
        <input type="hidden" name="cmd" value="2">
        <button class="ui blue submit button" type="submit" name="submit">가입하기</button>
        <a href="index.php">로그인하기</a>
        </form>
    </div>
  </div>
  <script src='https://code.jquery.com/jquery-3.3.1.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js'></script>
</body>
</html>