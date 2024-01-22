<?php
$dsn = 'mysql:host=aichi-database-1.clra1wx84nvf.ap-south-1.rds.amazonaws.com;dbname=aichi_log_db;charset=UTF8mb4';
$user = 'admin';
$pass = 'password';

try {
    $dbh = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    // POST データから spot_name を取得
    $spot_name = isset($_POST['spot_name']) ? $_POST['spot_name'] : '';

    // プリペアドステートメントを使用して SQL インジェクションを防ぐ
    $stmt = $dbh->prepare("SELECT spot_name, spot_hour, spot_location, spot_access, spot_detail, spot_image FROM spot WHERE spot_name = :spot_name");
    $stmt->bindParam(':spot_name', $spot_name, PDO::PARAM_STR);
    $stmt->execute();

    // 結果を取得
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // spot_image に拡張子が含まれていない場合、jpg を付け足す
    if ($result && isset($result['spot_image'])) {
        $result['spot_image'] .= 'jpg';
    }

    // 結果を JSON 形式で出力
    echo json_encode($result);

} catch (PDOException $e) {
    echo '接続失敗' . $e->getMessage();
    exit();
}
?>
