<?php
session_start();
require('../dbconnect.php');

if (!empty($_POST)) {
	// エラー項目の確認

	//名前
	if ($_POST['name'] == '') {
		$error['name'] = 'blank';
	}
	//フリガナ
	if ($_POST['furigana'] == '') {
		$error['furigana'] = 'blank';
	}
	//メールアドレス
	if ($_POST['email'] == '') {
		$error['email'] = 'blank';
	}
	//電話番号
	if ($_POST['tel'] == '') {
		$error['tel'] = 'blank';
	}
	//生年月日
	if ($_POST['birth'] == '') {
		$error['birth'] = 'blank';
	}
	//郵便番号
	if ($_POST['address'] == '') {
		$error['address'] = 'blank';
	}
	//都道府県
	if ($_POST['prefecture'] == '') {
		$error['prefecture'] = 'blank';
	}	
	//市町村
	if ($_POST['city'] == '') {
		$error['city'] = 'blank';
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
		header('Location: check333.php');
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
	<title>会員登録</title>
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

			<dt>フリガナ<span class="required">必須</span></dt>
			<dd>
			<?php if($error['furigana'] == 'blank'): ?>
			<p class="error">* フリガナを入力してください</p>
			<?php endif;?>
			<input type="text" name="furigana" size="35" maxlength="255"
			value="<?php echo htmlspecialchars($_POST['furigana'], ENT_QUOTES); ?>">
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

			<dt>電話番号（ハイフンなし）<span class="required">必須</span></dt>
			<dd>
			<?php if($error['tel'] == 'blank'): ?>
			<p class="error">* 電話番号を入力してください</p>
			<?php endif;?>
			<input type="text" name="tel" size="35" maxlength="255"
			value="<?php echo htmlspecialchars($_POST['tel'], ENT_QUOTES); ?>">
			</dd> 

			<dt>生年月日<span class="required">必須</span></dt>
			<dd>
			<?php if($error['birth'] == 'blank'): ?>
			<p class="error">* 生年月日を入力してください</p>
			<?php endif;?>
			<input type="select" name="birth" size="35"
			value="<?php echo htmlspecialchars($_POST['birth'], ENT_QUOTES); ?>">
			</dd>

			<dt>郵便番号（ハイフンなし）<span class="required">必須</span></dt>
			<dd>
			<?php if($error['address'] == 'blank'): ?>
			<p class="error">* 郵便番号を入力してください</p>
			<?php endif;?>
			<input type="text" name="address" size="10" maxlength="7"
			value="<?php echo htmlspecialchars($_POST['address'], ENT_QUOTES); ?>">
			</dd>

			<dt>都道府県<span class="required">必須</span></dt>
			<dd>
			<?php if($error['prefecture'] == 'blank'): ?>
			<p class="error">* 都道府県を入力してください</p>
			<?php endif;?>
			<input type="text" name="prefecture" size="35" maxlength="255"
			value="<?php echo htmlspecialchars($_POST['prefecture'], ENT_QUOTES); ?>">
			</dd>

			<dt>市町村・番地<span class="required">必須</span></dt>
			<dd>
			<?php if($error['city'] == 'blank'): ?>
			<p class="error">* 市町村・番地を入力してください</p>
			<?php endif;?>
			<input type="text" name="city" size="35" maxlength="255"
			value="<?php echo htmlspecialchars($_POST['city'], ENT_QUOTES); ?>">
			</dd>

			<dt>建物</dt>
			<dd>
			<input type="text" name="building" size="10" maxlength="20"
			value="<?php echo htmlspecialchars($_POST['building'], ENT_QUOTES); ?>">
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
