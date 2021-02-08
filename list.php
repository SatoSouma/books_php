<?php
if(isset($_GET['success'])){
    echo $_GET['success'];
}
// const.phpから定数取得。
require_once'./const.php';

// $upload変数受け取り。
//ファイル
@$upload_file = $_FILES['upload_file'];
@$title = $_POST['title'];
@$volume = $_POST['volume'];
@$price = $_POST['price'];
@$release_date = $_POST['release_date'];
@$purchase_date = $_POST['purchase_date'];

// DB接続。
$link = @mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
// 飛んできた情報をindertでDBに保存。
// 入力データが送られてきてるかどうか確認。
if(isset($title) || isset($volume) || isset($price) || isset($release_date)){
    // DBエラー
    if(!$link){
        $err_msg = '予期せぬエラーが発生しました。しばらくたってから再度お試しください。(エラーコード：101)';
        require_once './tpl/error.php';
        exit;
    }
    // 購入日が空になるのでnullが入る。
    if(empty($purchase_date)){
        mysqli_set_charset($link,'utf8');
        $sql = "INSERT INTO m_book (title , volume , price , release_date) VALUES ('" . $title . "'," . $volume . "," . $price . "," . $release_date . ")";
    }else{
        mysqli_set_charset($link,'utf8');
        $sql = "INSERT INTO m_book (title , volume , price , release_date , purchase_date) VALUES ('" . $title . "'," . $volume . "," . $price . "," . $release_date . "," . $purchase_date . ")";
    }
    $result = mysqli_query($link,$sql);
    if(!$result){
        mysqli_close($link);
        $err_msg = '予期せぬエラーが発生しました。しばらくたってから再度お試しください。(エラーコード：102)';
        require_once './tpl/error.php';
        exit;
    }
    // insert_idでID取得。
    $id = mysqli_insert_id($link);
}

// ファイル保存。
// 取得したIDでimgフォルダに保存。
if(isset($upload_file)){
    move_uploaded_file($upload_file['tmp_name'],DIR_IMG . $id . '.' . 'jpg');
}

// 発売日を降順に単行本の一覧を表示する。
// SERECT文で全件取得。
if(isset($_POST['search'])){
    mysqli_set_charset($link,'utf8');
    $sql = "SELECT * FROM m_book WHERE title LIKE '%" . $_POST['search'] . "%'";
    $result = mysqli_query($link,$sql);
    // エラーチェック。
    if(!$result){
        mysqli_close($link);
        $err_msg = '予期せぬエラーが発生しました。しばらくたってから再度お試しください。(エラーコード：102)';
        require_once './tpl/error.php';
        exit;
    }
    $all = [];
    while($row = mysqli_fetch_assoc($result)){
        if($row['del_date'] == null){
            $all[] = $row;
        }
    }
}else{
    mysqli_set_charset($link,'utf8');
    $sql = "SELECT * FROM m_book";
    $result = mysqli_query($link,$sql);
    // エラーチェック。
    if(!$result){
        mysqli_close($link);
        $err_msg = '予期せぬエラーが発生しました。しばらくたってから再度お試しください。(エラーコード：102)';
        require_once './tpl/error.php';
        exit;
    }
    $all = [];
    while($row = mysqli_fetch_assoc($result)){
        if($row['del_date'] == null){
            $all[] = $row;
        }
    }
}
mysqli_close($link); 

// 発売日を降順でソート。
for($e = 0;$e < count($all);$e++){
    for($n = 1;$n < count($all);$n++){
        if($all[$n-1]['release_date'] < $all[$n]['release_date']){
            $temp = $all[$n-1];
            $all[$n-1] = $all[$n];
            $all[$n] = $temp;
        }
    }
}

// 購入日がnullの時 '-' を代入する。 年月日を連結。
foreach($all as $key => $val){
    if(isset($val['purchase_date'])){
        $val['release_date'] = explode('-',$val['release_date']);
        $val['purchase_date'] = explode('-',$val['purchase_date']);
        $val['release_date'] = $val['release_date'][0].'年'.$val['release_date'][1].'月'.$val['release_date'][2].'日';
        $val['purchase_date'] = $val['purchase_date'][0].'年'.$val['purchase_date'][1].'月'.$val['purchase_date'][2].'日'; 
    }else{
        $val['release_date'] = explode('-',$val['release_date']);
        $val['release_date'] = $val['release_date'][0].'年'.$val['release_date'][1].'月'.$val['release_date'][2].'日';
        // 購入日がnullの時 '-' を代入する。
        $val['purchase_date'] = '-';
    }
    $all[$key] = $val;
}

// 価格昇順ソート
if(isset($_POST['up'])){
    for($e = 0;$e < count($all);$e++){
        for($n = 1;$n < count($all);$n++){
            if($all[$n-1]['price'] > $all[$n]['price']){
                $temp = $all[$n-1];
                $all[$n-1] = $all[$n];
                $all[$n] = $temp;
            }
        }
    }
}

// 価格降順ソート
if(isset($_POST['down'])){
    for($e = 0;$e < count($all);$e++){
        for($n = 1;$n < count($all);$n++){
            if($all[$n-1]['price'] < $all[$n]['price']){
                $temp = $all[$n-1];
                $all[$n-1] = $all[$n];
                $all[$n] = $temp;
            }
        }
    }
}

require_once './tpl/list.php';