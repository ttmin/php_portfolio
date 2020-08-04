<?php
session_start();
require('../dbconnect.php');

if (!isset($_SESSION['join'])) {
	header('Location: index333.php');
	exit();
}

if (!empty($_POST)) {
  //登録処理をする
  $statement = $db->prepare('INSERT INTO members SET name=?, furigana=?, email=?, tel=?, birth=?, address=?, prefecture=?, city=?, building=?, password=?, created=NOW()');
  echo $ret = $statement->execute(array(
    $_SESSION['join']['name'],
    $_SESSION['join']['furigana'],
    $_SESSION['join']['email'],
    $_SESSION['join']['tel'],
    $_SESSION['join']['birth'],
    $_SESSION['join']['address'],
    $_SESSION['join']['prefecture'],
    $_SESSION['join']['city'],
    $_SESSION['join']['building'],
    sha1($_SESSION['join']['password'])
  ));
  unset($_SESSION['join']);

  header('Location: thanks.php');
  exit();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>会員登録</title>
	<link rel="stylesheet" href="../style.css" />
</head>

<body>
<div id="wrap">
  <div id="head">
    <h1>入力内容確認</h1>
  </div>
  <div id="content">
		<form action="" method="post">
			<input type="hidden" name="action" value="submit">
			<dl>
			<dt>お名前</dt>
			<dd>
			<?php echo htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES); ?>
			</dd>

			<dt>フリガナ</dt>
			<dd>
			<?php echo htmlspecialchars($_SESSION['join']['furigana'], ENT_QUOTES); ?>
			</dd>

			<dt>メールアドレス</dt>
			<dd>
			<?php echo htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES); ?>
			</dd>

			<dt>電話番号</dt>
			<dd>
			<?php echo htmlspecialchars($_SESSION['join']['tel'], ENT_QUOTES); ?>
			</dd>

			<dt>生年月日</dt>
			<dd>
			<?php echo htmlspecialchars($_SESSION['join']['birth'], ENT_QUOTES); ?>
			</dd>

			<dt>郵便番号</dt>
			<dd>
			<?php echo htmlspecialchars($_SESSION['join']['address'], ENT_QUOTES); ?>
			</dd>

			<dt>都道府県</dt>
			<dd>
			<?php echo htmlspecialchars($_SESSION['join']['prefecture'], ENT_QUOTES); ?>
			</dd>

			<dt>市町村番地</dt>
			<dd>
			<?php echo htmlspecialchars($_SESSION['join']['city'], ENT_QUOTES); ?>
			</dd>

			<dt>建物</dt>
			<dd>
			<?php echo htmlspecialchars($_SESSION['join']['building'], ENT_QUOTES); ?>
			</dd>

			<dt>パスワード</dt>
			<dd>
			【表示されません】
			</dd>

			</dl>
			<div><a href="index333.php?action=rewrite">&laquo;&nbsp;修正する</a> | <input
			type="submit" value="登録する" /></div>
		</form>
  </div>

</div>
</body>
</html>
