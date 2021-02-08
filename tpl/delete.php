<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- 画像調整のcss -->
    <link href="./css/photo.css" rel="stylesheet">
    <!-- 調整css -->
    <link href="./css/show.css" rel="stylesheet">
    <!-- BootstrapのCSS読み込み -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="./modernizr.custom.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST" action="">
<table class="table table-bordered">
    <tr>
        <td class="back">漫画名</td>
        <td><?php echo $all[0]['title']; ?></td>
    </tr>
    <tr>
        <td class="back">巻数</td>
        <td><?php echo $all[0]['volume']; ?>巻</td>
    </tr>
    <tr>
        <td class="back">価格</td>
        <td><?php echo $all[0]['price']; ?>円</td>
    </tr>
    <tr>
        <td class="back">発売日</td>
        <td><?php echo $all[0]['release_date']; ?></td>
    </tr>
    <tr>
        <td class="back">購入日</td>
        <td><?php echo $all[0]['purchase_date'] ?></td>
    </tr>
    <tr>
        <td class="back">画像</td>
        <td><img src ="<?php echo DIR_IMG . $all[0]['id'] . '.' . 'jpg' ?>" class='size'></td>
    </tr>
    <tr>
        <td colspan="2"><input type='hidden' name='id' value=<?php echo $all[0]['id']; ?>><button type = "submit" class="btn btn-info">単行本の情報を削除する</button></td>
    </tr>
</form>
</body>
</html>