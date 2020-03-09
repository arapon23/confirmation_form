<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", "0");						//エラー表示：1　非表示:0
date_default_timezone_set('Asia/Tokyo');
require_once("./PHPMailer/PHPMailerAutoload.php");	//ライブラリー読込
mb_language("japanese");
mb_internal_encoding("UTF-8");


//認証情報
$host          = "smtp.example.com";
$smtp_user     = "arai.yuta2019@gmail.com";
$smtp_password = "fdxq psoa iqni tfoz";
$from          = "from mail address";
$port          = 25;
$ssl_type      = "ssl";


//宛先・件名・本文
//POSTやGETでメールを送信する場合
//$fromname = "送信者名だよ";
//$to       = urldecode(htmlspecialchars($_POST["to"],  ENT_QUOTES));
//$subject  = urldecode(htmlspecialchars($_POST["subject"],  ENT_QUOTES));
//$body     = urldecode(htmlspecialchars($_POST["body"],  ENT_QUOTES));

//固定テキストでテスト用
$name = "送信者名だよ";
$to       = "info@example.com";
$subject  = "十分に長い日本語の題名（subject）を作成しましょう、ｱｲｳｴｵかきくけこサシスセソ";
$message     = "ここに本文が入りますよ！ここに本文が入りますよ！
ここに本文が入りますよ！ここに本文が入りますよ！ここに本文が入りますよ！ここに本文が入りますよ！
十分に長い日本語の題名（subject）を作成しましょう、ｱｲｳｴｵかきくけこサシスセソ";


//メール送信
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth    = true;
//$mail->SMTPDebug   = 2;	//デバッグなどを行うときはコメントアウトを解除！
$mail->SMTPOptions = array(
	'ssl' => array(
		'verify_peer'       => false,	//SSLサーバー証明書の検証を要求するか（デフォルト：true）
		'verify_peer_name'  => false,	//ピア名の検証を要求するか（デフォルト：true）
		'allow_self_signed' => true		//自己証明の証明書を許可するか（デフォルト：false、trueにする場合は「verify_peer」をfalseに）
	)
);
$mail->CharSet    = "utf-8";
$mail->SMTPSecure = $ssl_type;
$mail->Host       = $host;
$mail->Port       = $port;
$mail->IsHTML(false);
$mail->Username   = $smtp_user;
$mail->Password   = $smtp_password; 
$mail->SetFrom($smtp_user);
$mail->From       = $from;
$mail->FromName   = mb_encode_mimeheader($name, "JIS", "UTF-8");
$mail->Subject    = mb_encode_mimeheader($subject,  "JIS", "UTF-8");
$mail->Body       = $message;
$mail->AddAddress($to);


//送信判定
if ($mail->Send()) {
	echo "送信が成功したよ！";
} else {
	echo "送信が失敗したよ、、設定ミスがあるのかもね、、";
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>お問い合わせフォーム</title>

  <!-- タイトルの下にBootstrapを記入 -->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="css/style.css">

</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-8 col-sm-offset-2">
        <header>
          <h1 class="text-center">お問い合わせフォーム</h1>
        </header>
        
        <hr>

        <!-- 未入力の場合、アラートを追加 -->
        <?php if ($err_msg != '') : ?>
          <div class="alert alert-danger">
            <?php echo $err_msg; ?>
          </div>
        <?php endif; ?>

        <?php if ($complete_msg != '') : ?>
          <div class="alert alert-success">
            <?php echo $complete_msg; ?>
          </div>
        <?php endif; ?>

        <!-- POSTで送信 -->
        <form method="POST" class="row">

          <div class="form-group">
            <label for="name">お名前</label>
            <input type="text" id="name" name="my_name" class="form-control" placeholder="例） お名前" value="<?php echo $name; ?>">
          </div>

          <div class="form-group">
            <label for="my_mail">メールアドレス<span class="label label-danger">正しく入力</span></label>
            <input type="email" id="my_mail" name="email" class="form-control" placeholder="例） xxx@example.com" value="<?php echo $email; ?>">
          </div>

          <div class="form-group">
            <label for="subject">件名</label>
            <input type="text" id="subject" name="subject" class="form-control" placeholder="件名" value="<?php echo $subject; ?>">
          </div>

          <div class="form-group">
            <label for="message">お問合せ内容</label>
            <textarea name="message" rows="10" class="form-control" placeholder="こちらにお問合せ内容をご入力ください。" value="<?php echo $message; ?>"></textarea>
          </div>

          <button type="submit" class="btn btn-success btn-block">送信する</button>
        </form>
      </div>
    </div>
  </div>

  <hr>

  <div class="container text-center">
    <footer>
      <p>&copy; Boxez</p>
    </footer>
  </div>

</body>
</html>