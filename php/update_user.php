<?php
session_start();

// データベース接続情報
$dsn = 'mysql:host=aichi-database-1.clra1wx84nvf.ap-south-1.rds.amazonaws.com;dbname=aichi_log_db;charset=UTF8mb4'; 
$user = 'admin';
$pass = 'password';

try {
    // データベースに接続
    $dbh = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    // ユーザー情報取得
    $username = $_SESSION['user']['username'];
    $email = $_SESSION['user']['email'];
    $newUsername = $_POST['new_username']; // POST リクエストから新しいユーザー名を取得
    $newEmail = $_POST['new_email']; // POST リクエストから新しいメールアドレスを取得
    $newPassword = $_POST['new_password']; // POST リクエストから新しいパスワードを取得

    // ユーザー名とメールアドレスが変更されているか確認
    if ($newUsername != $username || $newEmail != $email) {
        // ユーザー名またはメールアドレスが変更された場合、更新
        $updateUserQuery = 'UPDATE user SET username = :newUsername, email = :newEmail WHERE username = :username';
        $stmtUpdateUser = $dbh->prepare($updateUserQuery);
        $stmtUpdateUser->bindParam(':newUsername', $newUsername, PDO::PARAM_STR);
        $stmtUpdateUser->bindParam(':newEmail', $newEmail, PDO::PARAM_STR);
        $stmtUpdateUser->bindParam(':username', $username, PDO::PARAM_STR);
        $stmtUpdateUser->execute();

        // セッションのユーザー情報も更新
        $_SESSION['user']['username'] = $newUsername;
        $_SESSION['user']['email'] = $newEmail;
    }

    // パスワードが変更されているか確認
    if (!empty($newPassword)) {
        // パスワードが変更された場合、更新
        $updatePasswordQuery = 'UPDATE user SET password = :newPassword WHERE username = :username';
        $stmtUpdatePassword = $dbh->prepare($updatePasswordQuery);
        $stmtUpdatePassword->bindParam(':newPassword', $newPassword, PDO::PARAM_STR);
        $stmtUpdatePassword->bindParam(':username', $username, PDO::PARAM_STR);
        $stmtUpdatePassword->execute();
    }

    // データベース接続を閉じる
    $dbh = null;

    // 成功時の処理（例: 成功メッセージを返す）
    echo json_encode(['status' => 'success', 'message' => 'ユーザー情報を更新しました。']);

} catch (PDOException $e) {
    // エラー時の処理（例: エラーメッセージを返す）
    echo json_encode(['status' => 'error', 'message' => 'データベースエラー: ' . $e->getMessage()]);
    exit();
}
?>
