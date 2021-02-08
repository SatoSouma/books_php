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
        <td><input type='text' name='title' value="<?php echo $all[0]['title']; ?>"></td>
    </tr>
    <tr>
        <td class="back">巻数</td>
        <td><input type='text' name='volume' value="<?php echo $all[0]['volume']; ?>">巻</td>
    </tr>
    <tr>
        <td class="back">価格</td>
        <td><input type='text' name='price' value="<?php echo $all[0]['price']; ?>">円</td>
    </tr>
    <tr>
        <td class="back">発売日</td>
        <td><input type='text' name='release_date' value="<?php echo $all[0]['release_date']; ?>"></td>
    </tr>
    <tr>
        <td class="back">購入日</td>
        <td><input type='text' name='purchase_date' value="<?php echo $all[0]['purchase_date']; ?>"></td>
    </tr>
    <tr>
        <td class="back">画像</td>
        <td><img src ="<?php echo DIR_IMG . $all[0]['id'] . '.' . 'jpg' ?>" class='size'></td>
    </tr>
    <tr>
        <td colspan="2"><button type = "submit" class="btn btn-info">送信</button></td>
    </tr>     
</form>
</body>
</html>