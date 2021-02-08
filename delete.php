<?php
// 定数取得
require_once './const.php';

// DB接続。
$link = @mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
// 飛んできた情報をindertでDBに保存。
// 入力データが送られてきてるかどうか確認。
if(isset($_POST['id'])){
    // 削除した日の日付。
    $date = date('y/m/d');
    $center = explode('/',$date);
    $date = $center[0].$center[1].$center[2]; 
    var_dump($date);
    // DBエラー
    if(!$link){
        $err_msg = '予期せぬエラーが発生しました。しばらくたってから再度お試しください。(エラーコード：101)';
        require_once './tpl/error.php';
        exit;
    }
    mysqli_set_charset($link,'utf8');
    $sql = "UPDATE m_book SET del_date = " . $date . " WHERE id = " . $_POST['id'];
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


// id受け取ってidに紐づくカラムをSELECTでとってくる。
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

require_once './tpl/delete.php';