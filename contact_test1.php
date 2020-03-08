<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  // POSTでのアクセスでない場合
  $my_name = '';
  $email = '';
  $subject = '';
  $message = '';
  $err_msg = '';
  $complete_msg = '';

} else {
  // フォームが送信された場合（POST処理）
  // 入力された値を取得する
  $name = $_POST['my_name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  // エラーメッセージ・完了メッセージの用意
  // おそらく変数は最初から初期化しないと、エラーになる
  $err_msg = '';
  $complete_msg = '';

  // 空チェック
  if ($name == '' || $email == '' || $subject == '' || $message == '') {
    $err_msg = '全ての項目を入力してください。';
  }

  // エラーなし（全ての項目が入力されている）
  if ($err_msg == '') {
    $to = "kyotogamiyako30@gmail.com"; // 管理者のメールアドレスなど送信先を指定
    $headers = "From: " . $email . "\r\n";
    // 下記でも可能
    // $headers = "From: from@pg-happy.jp";

    // 本文の最後に名前を追加
    $message .= "\r\n\r\n" . $name;

    // メール送信
    mb_send_mail($to, $message, $headers);

    // 完了メッセージ
    $complete_msg = '送信されました！';

    // 全てクリア
    $name = '';
    $email = '';
    $subject = '';
    $message = '';
  }
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