<?php
$dsn = 'mysql:host=aichi-database-1.clra1wx84nvf.ap-south-1.rds.amazonaws.com;dbname=aichi_log_db;charset=UTF8mb4'; 
$user = 'admin';
$pass = 'password';

try {
    $dbh = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // フォームから送信されたメールアドレスとパスワード
        $user_input_email = isset($_POST['emailaddress']) ? $_POST['emailaddress'] : '';
        $user_input_password = isset($_POST['password']) ? $_POST['password'] : '';

        // ユーザー認証のためのSQLクエリ
        $sql = 'SELECT * FROM user WHERE emailaddress = :email';
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':email', $user_input_email, PDO::PARAM_STR);
        $stmt->execute();

        // ユーザー情報を取得
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // パスワードの検証
        if ($user && $user_input_password === $user['password']) {
            // ログイン成功時にセッションにユーザー名を保存
            $_SESSION['username'] = $user['username'];

            // ログイン成功時にsearch.htmlにリダイレクト
            header('Location: ../search/search.html');
            exit;
        } else {
            echo 'メールアドレスまたはパスワードが正しくありません。';
        }
    }

    $dbh = null;

} catch (PDOException $e) {
    echo '接続失敗' . $e->getMessage();
    exit();
}
?>
