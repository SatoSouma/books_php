<?php
// 定数取得
require_once './const.php';

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
        $sql = "UPDATE m_book SET title = '" . $title . "',volume = " . $volume . ",price = " . $price . ",release_date = " . $release_date . ",purchase_date = NULL WHERE id = " . $_GET['id'];
    }else{
        mysqli_set_charset($link,'utf8');
        $sql = "UPDATE m_book SET title = '" . $title . "',volume = " . $volume . ",price = " . $price . ",release_date = " . $release_date . ",purchase_date = " . $purchase_date . "  WHERE id = " . $_GET['id'];
    }
    $result = mysqli_query($link,$sql);
    if(!$result){
        mysqli_close($link);
        $err_msg = '予期せぬエラーが発生しました。しばらくたってから再度お試しください。(エラーコード：102)';
        require_once './tpl/error.php';
        exit;
    }
    $success_msg = '更新完了';
    $url = './list.php?success='. $success_msg;
    header('Location: '. $url);
}


if(!isset($_GET['id'])){
    $err_msg = '予期せぬエラーが発生しました。しばらくたってから再度お試しください。(エラーコード：101)';
    require_once './tpl/error.php';
    exit;
}

$id = $_GET['id'];

//  list.phpから飛んできたidに紐づくカラムをSELECTで奪取。
mysqli_set_charset($link,'utf8');
$sql = "SELECT * FROM m_book WHERE id = " . $id ;
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
    $all[] = $row;
}
mysqli_close($link); 

// 発売日と購入日内の数字間の - を取り除く。
foreach($all as $key => $val){
    if(isset($val['purchase_date'])){
        $val['release_date'] = explode('-',$val['release_date']);
        $val['purchase_date'] = explode('-',$val['purchase_date']);
        $val['release_date'] = $val['release_date'][0].$val['release_date'][1].$val['release_date'][2];
        $val['purchase_date'] = $val['purchase_date'][0].$val['purchase_date'][1].$val['purchase_date'][2]; 
    }else{
        $val['release_date'] = explode('-',$val['release_date']);
        $val['release_date'] = $val['release_date'][0].$val['release_date'][1].$val['release_date'][2];
    }
    $all[$key] = $val;
}

require_once './tpl/update.php';

// idに紐付くカラムの更新。