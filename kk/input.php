<?php require('dbconnect.php'); ?>
<!doctype html>
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
<?php
$memos = $db->prepare('SELECT * FROM members WHERE id=?');
$memos->execute(array($id));
$memo = $memos->fetch();
?>

<form action="input_do.php" method="post">
	<input type="hidden" name="id" value="<?php echo($id); ?>">
    <textarea name="memo" cols="50" rows="10" placeholder="メモを入力してください"></textarea><br>
    <button type="submit">登録する</button>
</form>
</main>
</body>
</html>
