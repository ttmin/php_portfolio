<?php
session_start();

require('dbconnect.php');

//投稿を記録する
if (!empty($_POST)) {
	if ($_POST['memo'] != '') {
		$message = $db->prepare('INSERT INTO memos SET member_id=?, memo=?, created=NOW()');
		$message->execute(array(
			$member['id'],
			$_POST['memo']
		));

		header('Location: input_do.php');
		exit();
	}
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="../../../css/style.css">

<title>よくわかるPHPの教科書</title>
</head>

<body>
<header>
<h1 class="font-weight-normal">よくわかるPHPの教科書</h1>
</header>

<main>
<h2>フォームからの情報を保存する</h2>
<pre>
<?php
echo 'メモが登録されました';
?>
</pre>

<a href="index_memo_all.php">一覧にもどる</a>
　|
<a href="index_memo_all.php">編集する</a>

</main>
</body>
</html>
