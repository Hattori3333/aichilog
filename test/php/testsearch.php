<?php
$dsn = 'mysql:host=aichi-database-1.clra1wx84nvf.ap-south-1.rds.amazonaws.com;dbname=aichi_log_db;charset=UTF8mb4';
$user = 'admin';
$pass = 'password';

try {
    $dbh = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    // 検索ボタンが押された場合の処理
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $region = $_POST['region'];
        $genre = $_POST['genre'];

        // プリペアドステートメントを使用してSQLインジェクションを防ぐ
        $stmt = $dbh->prepare("SELECT spot_name, spot_hour FROM spot WHERE region = :region AND genre = :genre");
        $stmt->bindParam(':region', $region, PDO::PARAM_STR);
        $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
        $stmt->execute();

        // 結果を取得
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump($results);
    }

} catch (PDOException $e) {
    echo '接続失敗' . $e->getMessage();
    exit();
}
?>