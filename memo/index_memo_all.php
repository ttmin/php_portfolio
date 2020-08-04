<?php 
session_start();
require('dbconnect.php');

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
	//ログインしている
	$_SESSION['time'] = time();

	$members = $db->prepare('SELECT * FROM members WHERE id=?');
	$members->execute(array($_SESSION['id']));
	$member = $members->fetch();
} else {
	//ログインしていない
	header('Location: login_memo.php');
	exit();
}

?>

<!doctype html>
<html lang="ja">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/style.css">

<title>よくわかるPHPの教科書</title>
</head>
<body>
<header>
<h1 class="font-weight-normal">よくわかるPHPの教科書</h1>    
</header>

<main>
<?php
if (isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])) {
	$page = $_REQUEST['page'];
} else {
	$page = 1;
}

$start = 5 * ($page-1);
$memos = $db->prepare('SELECT * FROM memos ORDER BY id LIMIT ?,5');
$memos->bindParam(1, $start, PDO::PARAM_INT);
$memos->execute();
?>

<a href="input.php"><button>+ Add</button></a>

<article>
<?php while ($memo = $memos->fetch()): ?>
	<p><a href="memo_memo.php?id=<?php echo $memo['id']; ?>"><?php echo mb_substr($memo['memo'], 0, 50); ?></a></p>
	<time><?php echo $memo['created']; ?></time>
<?php endwhile; ?>

<?php if($page >= 2): ?>
<a href="index_memo_all.php?page=<?php echo ($page-1); ?>"><?php echo ($page-1); ?>ページへ</a>
<?php endif; ?>

 | 

<?php 
$counts = $db->query('SELECT COUNT(*) AS cnt FROM memos');
$count = $counts->fetch();
$max_page = ceil($count['cnt'] / 5);
if ($page < $max_page):
?>
<a href="index_memo_all.php?page=<?php echo ($page+1); ?>"><?php echo ($page+1); ?>ページへ</a>
<?php endif; ?>
</article>
</main>
</body>
</html>