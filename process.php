<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php
session_start();
include("dbconfig.php");
ini_set('display_errors', 0);

define("CMD_REQUEST_LOGOUT", 0);
define("CMD_REQUEST_LOGIN", 1);
define("CMD_REQUEST_REGISTER", 2);
define("CMD_REQUEST_WRITE", 3);
define("CMD_REQUEST_EDIT", 4);

switch ((int) $_POST['cmd']) {
    case CMD_REQUEST_LOGOUT:
        if(isset($_POST["submit"])){
            session_destroy();
            die("<script>window.location.href='./index.php';</script>");
        } 
        break;
    case CMD_REQUEST_LOGIN:
        if (isset($_POST["submit"])) {
            if (empty($_POST["id"]) || empty($_POST["pw"])) {
                die("<script>alert('empty'); history.go(-1);</script>");
            } else {
                $id = $_POST['id'];
                $pw = $_POST['pw'];
                $id = addslashes($id);
                $id = stripslashes($id);
                $pw = stripslashes($pw);
                $id = mysqli_real_escape_string($conn, $id);
                $pw = mysqli_real_escape_string($conn, $pw);
                $pw = hash('sha512', $pw);

                $query = "select * from member where id='$id' and pw='$pw'";
                $row = mysqli_fetch_assoc($mysqli->query($query));

                if ($row) {
                    $_SESSION['id'] = $row['id'];
                    die("<script>alert('{$_SESSION['id']}님 오신걸 환영합니다.'); window.location.href='board.php';</script>");
                } else {
                    die("<script>alert('입력하신 계정이 로그인에 실패 하였습니다.'); history.go(-1);</script>");
                }
            }
        }
        break;
    case CMD_REQUEST_REGISTER:
        if (isset($_POST["submit"])) {
            if (empty($_POST["id"]) || empty($_POST["pw"])) {
                die("<script>alert('empty'); history.go(-1);</script>");
            } else {
                $id = $_POST['id'];
                $pw = $_POST['pw'];
                $id = addslashes($id);
                $id = stripslashes($id);
                $pw = addslashes($pw);
                $pw = stripslashes($pw);
                $id = mysqli_real_escape_string($conn, $id);
                $pw = mysqli_real_escape_string($conn, $pw);
                $pw = hash('sha512', $pw);

                if (strlen($id) > 30) {
                    die("<script>alert('입력하신 아이디가 너무 길어요ㅠ'); history.go(-1); </script>");
                } else if (strlen($id) < 3) {
                    die("<script>alert('입력하신 아이디가 너무 짧으신거 아니에요ㅠ?'); history.go(-1); </script>");
                }

                if (preg_match("/'|\"|\\|`|[*]|-|;|=/i", $id)) {
                    die("<script>alert('입력하신 아이디에 특수문자가 포함되어 있습니다.'); history.go(-1); </script>");
                }

                if (preg_match("/admin|administrator|root|관리자|어드민|test|테스트/i", $id)) {
                    die("<script>alert('당신은 관리자가 아닙니다.'); history.go(-1); </script>");
                }

                $query = "select id from member where id='$id'";
                $result = mysqli_fetch_array($mysqli->query($query));
                if ($result) {
                    die("<script>alert('입력하신 이메일이 중복 됩니다.'); history.go(-1); </script>");
                }

                $sql = "insert into member(id,pw) 
                values('$id','$pw')";

                $mysqli->query($sql);

                die("<script>alert('회원가입을 성공적으로 마쳤습니다!');window.location.href = 'board.php';</script>");
            }
        }
        break;
    case CMD_REQUEST_WRITE: // done!
        if (isset($_POST["submit"])) {
            if (empty($_POST["content"])) {
                die("<script>alert('empty'); history.go(-1);</script>");
            } else {
                $writer = $_SESSION['id'];
                $date = date('Y-m-d');
                $sql = "insert into board(content,date,id) values('".$_POST['content']."','".$date."','".$writer."')";
                $mysqli->query($sql);
                die("<script>alert('글쓰기 완료되었습니다.');window.location.href = 'board.php';</script>"); 
            }
        }
        break;
    case CMD_REQUEST_EDIT: // done!
        if (isset($_POST["submit"])) {
            if (empty($_POST["pw"]) || empty($_POST["title"]) || empty($_POST["content"])) {
                die("<script>alert('empty'); history.go(-1);</script>");
            } else {
                $bno = $_POST['idx'];
                $sql = mq("select * from board where idx='$bno';");
	            $board = $sql->fetch_array();
                $sql2 = "update board set id='".$_SESSION['id']."',content='".$_POST['content']."' where idx = '".$bno."'";
                $mysqli->query($sql2);
                $idx = $board['idx'];
                die("<script>alert('수정되었습니다!');window.location.href = '/school/read.php?idx=$idx';</script>");
            }
        }
        break;
    }
    ?>