<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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

<!-- form作成する。 -->
<form method="POST" action="./list.php" enctype="multipart/form-data">
<table class="table table-bordered"> 
    <tr>
        <td class="back">漫画名</td>
        <td><input type='text' name='title'></td>
    </tr>
    <tr>
        <td class="back">巻数</td>
        <td><input type='text' name='volume'>巻</td>
    </tr>
    <tr>
        <td class="back">価格</td>
        <td><input type='text' name='price'>円</td>
    </tr>
    <tr>
        <td class="back">発売日</td>
        <td><input type='text' name='release_date' placeholder="例)20200101"></td>
    </tr>
    <tr>
        <td class="back">購入日</td>
        <td><input type='text' name='purchase_date' placeholder="例)20200101"></td>
    </tr>
    <tr>
        <td class="back">画像</td>
        <td><input type="file" name="upload_file" ></td>
    </tr>
    <tr>
        <td colspan="2"><button type = "submit" class="btn btn-info">送信</button></td>
    </tr>     
</form>
    
</body>
</html>