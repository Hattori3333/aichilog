<?php
$dsn = 'mysql:host=aichi-database-1.clra1wx84nvf.ap-south-1.rds.amazonaws.com;dbname=aichi_log_db;charset=UTF8mb4';
$user = 'admin';
$pass = 'password';

try {
    $dbh = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    // カードがクリックされた観光地の spot_name を取得
    $spot_name = $_POST['spot_name'];

    // プリペアドステートメントを使用して詳細データを取得
    $stmt = $dbh->prepare("SELECT spot_detail FROM spot WHERE spot_name = :spot_name");
    $stmt->bindParam(':spot_name', $spot_name, PDO::PARAM_STR);
    $stmt->execute();

    // 結果を取得
    $detailData = $stmt->fetch(PDO::FETCH_ASSOC);

    // 結果をJSON形式で出力
    echo json_encode($detailData);

} catch (PDOException $e) {
    echo 'エラー: ' . $e->getMessage();
    exit();
}
?>
