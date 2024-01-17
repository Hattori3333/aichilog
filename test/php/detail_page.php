<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>観光地詳細ページ</title>
</head>

<body>
    <h1>観光地詳細ページ</h1>

    <?php
    // GET パラメータから詳細情報を取得
    $spotDetail = isset($_GET['spot_detail']) ? urldecode($_GET['spot_detail']) : '';

    // 詳細情報を表示
    echo '<p>' . $spotDetail . '</p>';
    ?>
</body>

</html>
