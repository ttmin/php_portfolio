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
<h2>メモを変更する、編集画面</h2>
<?php
$statement = $db->prepare('UPDATE memos SET memo=? WHERE id=?');
$statement->execute(array($_POST['memo'], $_POST['id']));
?>
<pre><p>メモの内容を変更しました</p></pre>
<p><a href="index.php">戻る</a></p>
</main>
</body>
</html>
