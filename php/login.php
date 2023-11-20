<?php
    $dsn = 'mysql:host=aichi-database-1.clra1wx84nvf.ap-south-1.rds.amazonaws.com;dbname=aichi_log_db;charset=UTF8mb4'; 
    $user = 'admin';
    $pass = 'password';

    try {
        $dbh = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);

        $sql = 'SELECT * FROM user';
        $stmt = $dbh->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $dbh = null;

        if (!empty($result)) {
            echo '<table>';
            echo '<tr><th>ID</th><th>ユーザー名</th><th>メールアドレス</th></tr>';
            foreach ($result as $row) {
                echo '<tr>';
                echo '<td>' . $row['userid'] . '</td>';
                echo '<td>' . $row['username'] . '</td>';
                echo '<td>' . $row['emailaddress'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo 'データがありません';
        }


    } catch (PDOException $e) {
        echo '接続失敗' . $e->getMessage();
        exit();
    }
?>