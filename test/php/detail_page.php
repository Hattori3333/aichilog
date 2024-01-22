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
    // GET パラメータから spot_name を取得
    $spot_name = isset($_GET['spot_name']) ? urldecode($_GET['spot_name']) : '';

    // spot_name が存在する場合は、詳細データを取得して表示
    if ($spot_name) {
        // XMLHttpRequest を使用して詳細データを取得
        echo '<script>';
        echo 'var xhr = new XMLHttpRequest();';
        echo 'xhr.onreadystatechange = function () {';
        echo '    if (xhr.readyState == 4 && xhr.status == 200) {';
        echo '        var detailData = JSON.parse(xhr.responseText);';
        echo '        displayDetailData(detailData);';
        echo '    }';
        echo '};';
        echo 'xhr.open("POST", "get_detail_data.php", true);';
        echo 'xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");';
        echo 'xhr.send("spot_name=" + encodeURIComponent("' . $spot_name . '"));';
        echo '</script>';
    }

    // 詳細データを表示する JavaScript 関数
    echo '<script>';
    echo 'function displayDetailData(detailData) {';
    echo '    var detailContainer = document.createElement("div");';
    echo '    detailContainer.id = "detail-container";';
    echo '    document.body.appendChild(detailContainer);';
    echo '    detailContainer.innerHTML = "<h2>" + detailData.spot_name + "</h2>" +';
    echo '                               "<p>営業時間: " + detailData.spot_hour + "</p>" +';
    echo '                               "<p>所在地: " + detailData.spot_location + "</p>" +';
    echo '                               "<p>アクセス: " + detailData.spot_access + "</p>" +';
    echo '                               "<p>詳細情報: " + detailData.spot_detail + "</p>";';
    echo '}';
    echo '</script>';
    ?>
</body>

</html>
        