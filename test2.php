<?php
require_once("./phpmailer/class.phpmailer.php");
mb_internal_encoding("UTF-8");

$to = "ara.pon-pon.23@kb4.so-net.ne.jp";      //宛先
$subject = "メールの件名";         //件名
$body = "メールの本文です。";      //本文
$from = "user@send.com";      //仮の差出人
$fromname = "送信者";      //仮の差し出し人名

$mail = new PHPMailer();
$mail->CharSet = "iso-2022-jp";
$mail->Encoding = "7bit";

$mail->IsSMTP();               //「SMTPサーバーを使うよ」設定
$mail->SMTPAuth = TRUE;        //「SMTP認証を使うよ」設定
$mail->Host = 'send.com:25';   // SMTPサーバーアドレス:ポート番号
$mail->Username = '55718';      // SMTP認証用のユーザーID:55718
$mail->Password = 'aiueo300';  // SMTP認証用のパスワード

$mail->AddAddress($to); 
$mail->From = $from;
$mail->FromName = mb_encode_mimeheader(mb_convert_encoding($fromname,"JIS","UTF-8"));
$mail->Subject = mb_encode_mimeheader(mb_convert_encoding($subject,"JIS","UTF-8"));
$mail->Body = mb_convert_encoding($body,"JIS","UTF-8");

//メールを送信
$mail->Send();
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