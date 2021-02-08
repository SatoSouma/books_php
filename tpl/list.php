<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BootstrapのCSS読み込み -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- 横並びのcss -->
    <link href="./css/side.css" rel="stylesheet">
    <!-- 画像調整のcss -->
    <link href="./css/photo.css" rel="stylesheet">
    <!-- 調整css -->
    <link href="./css/show.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="./modernizr.custom.js"></script>
    <title>Document</title>
</head>
<body class="container mt-5 mb-5">
<h1 class="center">単行本一覧</h1>
<form method="POST" action="./list.php">
    <input type="text" name='search' placeholder="検索" class="form-group">
    <button type = "submit"　class="btn btn-info">送信</button>
</form>
<table class='table table-bordered'>
    <tr>
        <th class='center' class="back">タイトル</th>
        <th class='center' class="back">巻数</th>
        <th class="center" class="back">価格<div class="side"><form action="" method="POST"><button><input type='hidden' name='up'>昇順</button></form><form action="" method="POST"><button><input type='hidden' name='down'>降順</button></form></div></th>
        <th class='center' class="back">発売日</th>
        <th class='center' class="back">購入日</th>
        <th class='center' class="back">画像</th>
        <th class='center' class="back">変更・削除</th>
    </tr>
<?php foreach($all as $val2){ ?>
    <tr>
        <td class='center'><?php echo $val2['title'] ?></td>
        <td class='center'><?php echo $val2['volume'] ?>巻</td>
        <td class='center'><?php echo $val2['price'] ?>円</td>
        <td class='center'><?php echo $val2['release_date'] ?></td>
        <td class='center'><?php echo $val2['purchase_date'] ?></td>
        <td class='center'><img src ="<?php echo DIR_IMG . $val2['id'] . '.' . 'jpg' ?>" class='size'></td>
        <td class='center'><a href="./update.php?id=<?php echo $val2['id'];?>">変更</a>●<a href="./delete.php?id=<?php echo $val2['id'];?>">削除</a></td>
    </tr>
<?php } ?>
</table>
<p><a href="./insert.php">入力画面へ戻る。</a><p>
</body>
</html>