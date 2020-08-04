<?php
session_start();
require('../dbconnect.php');

if (!empty($_POST)) {
	// エラー項目の確認

	//名前
	if ($_POST['name'] == '') {
		$error['name'] = 'blank';
	}

	//メールアドレス
	if ($_POST['email'] == '') {
		$error['email'] = 'blank';
	}

	//パスワード
	if (strlen($_POST['password']) < 6) {
    $error['password'] = 'length';
  	}
  	if ($_POST['password'] == '') {
    $error['password'] = 'blank';
  	}

  	//重複アカウントチェック
	if (empty($error)) {
	  	$member = $db->prepare('SELECT COUNT(*) AS cnt FROM members WHERE email=?');
	  	$member->execute(array($_POST['email']));
	  	$record = $member->fetch();
  			if ($record['cnt'] > 0) {
  				$error['email'] = 'duplicate';
  			}
 	}

 	if (empty($error)) {
		$_SESSION['join'] = $_POST;
		header('Location: check_memo.php');
		exit();
	}
}

	//書き直し
	if ($_REQUEST['action'] == 'rewrite') {
		$_POST = $_SESSION['join'];
		$error['rewrite'] =  true;
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
    <h1>お客様情報の入力</h1>
  </div>
  <div id="content">
		<p>次のフォームに必要事項をご記入ください。</p>
		<form action="" method="post" enctype="multipart/form-data">
		<dl>

			<dt>お名前<span class="required">必須</span></dt>
			<dd>
			<?php if($error['name'] == 'blank'): ?>
			<p class="error">* お名前を入力してください</p>
			<?php endif;?>
			<input type="text" name="name" size="35" maxlength="255" 
			value="<?php echo htmlspecialchars($_POST['name'], ENT_QUOTES); ?>">
			</dd>
			
			<dt>メールアドレス<span class="required">必須</span></dt>
			<dd>
			<?php if($error['email'] == 'blank'): ?>
			<p class="error">* メールアドレスを入力してください</p>
			<?php endif;?>
			<?php if($error['email'] == 'duplicate'): ?>
			<p class="error">* 既に登録されたメールアドレスです</p>
			<?php endif;?>
			<input type="text" name="email" size="35" maxlength="255"
			value="<?php echo htmlspecialchars($_POST['email'], ENT_QUOTES); ?>">
			</dd>

			<dt>パスワード設定<span class="required">必須</span></dt>
			<dd>
			<?php if($error['password'] == 'blank'): ?>
	        <p class="error">* パスワードを入力してください</p>
	        <?php endif; ?>
	        <?php if($error['password'] == 'length'): ?>
	        <p class="error">* パスワードは6文字以上で入力してください</p>
	        <?php endif; ?>
	        </dd>
			<input type="password" name="password" size="10" maxlength="20"
			value="<?php echo htmlspecialchars($_POST['password'], ENT_QUOTES); ?>">
			</dd>
		</dl>
		
		<div><input type="submit" value="入力内容を確認する"></div>
		</form>
  </div>

</div>
</body>
</body>
</html>
