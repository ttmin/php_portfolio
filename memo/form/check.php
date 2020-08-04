<?php
session_start();
require('../dbconnect.php');

if (!isset($_SESSION['join'])) {
	header('Location: index_memo_form.php');
	exit();
}

if (!empty($_POST)) {
  //登録処理をする
  $statement = $db->prepare('INSERT INTO members SET name=?, email=?, password=?, created=NOW()');
  echo $ret = $statement->execute(array(
    $_SESSION['join']['name'],
    $_SESSION['join']['email'],
    sha1($_SESSION['join']['password'])
  ));
  unset($_SESSION['join']);

  header('Location: thanks_memo.php');
  exit();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ユーザー登録</title>
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

			<dt>メールアドレス</dt>
			<dd>
			<?php echo htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES); ?>
			</dd>

			<dt>パスワード</dt>
			<dd>
			【表示されません】
			</dd>

			</dl>
			<div><a href="index_memo_form.php?action=rewrite">&laquo;&nbsp;修正する</a> | <input
			type="submit" value="登録する" /></div>
		</form>
  </div>

</div>
</body>
</html>
