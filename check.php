<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>確認画面</title>
</head>

<body>
  <h2>お問い合わせ内容</h2>

  <form action="mailto.php" method="post">

    <table border="1">
      <tr>
        <td>名前</td>
        <td><?php echo $_POST["name"]; ?></td>
      </tr>
      <tr>
        <td>メールアドレス</td>
        <td><?php echo $_POST["mail"]; ?></td>
      </tr>
      <tr>
        <td>問い合わせ内容</td>
        <td><?php echo $_POST["inquiry"]; ?></td>
      </tr>
    </table>

    <input type="submit" value="送信" />
  </form>

</body>

</html>