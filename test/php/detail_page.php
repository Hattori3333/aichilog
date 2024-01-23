<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>観光地詳細ページ</title>
    <style>
#header {
  width: 100vw;
  height: 100px;
  background-color: #232323;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 30px;
  /* position: fixed; */
  top: 0;
  box-sizing: border-box;
}

        #header .logo a {
  color: #c2c2c2;
  font-size: 30px;
}

/* nav */

#header .nav__list {
  list-style: none;
  display: flex;
}

#header .nav__item a {
  padding: 10px 15px;
  color: #c2c2c2;
  font-weight: bold;
}

#header .nav__item a:hover {
  text-decoration: underline;
}

form {
  margin-top: 20px;
}


        body {
            font-family: Arial, sans-serif;
            background-color: #333;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: #fff;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #eee;
        }

        #detail-container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #444;
            border: 1px solid #555;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-wrap: wrap;
        }

        #detail-container img {
            width: 100%;
            max-width: 400px;
            height: auto;
            border-radius: 8px;
            margin-right: 20px;
            margin-bottom: 20px;
            padding-left: 220px;
        }

        #detail-container h2 {
            color: #eee;
            flex: 1 100%;
        }

        #detail-container p {
            flex: 1 100%;
            margin: 10px 0;
            color: #ddd;
        }
    </style>
</head>

<body>
    <header id="header">
            <h1 class="logo"><a href="../test/testsearch.html">AICHI-LOG</a></h1>
            <nav>
                <ul class="nav__list" id="navList">
                    <li class="nav__item" id="loginNavItem"><a href="../login/login.html">LOGIN</a></li>
                </ul>
            </nav>
    </header>
    <script>
        var username = "<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>";

        // ユーザー名が存在する場合、ナビゲーションメニューのテキストを変更
        if (username) {
            document.getElementById("navList").innerHTML = '<li class="nav__item" id="usernameNavItem"><a href="../mypage/EditAccountInformation.html">' + username + '</a></li>' +
                '<li class="nav__item"><a href="../login/logout.php">LOGOUT</a></li>';
        }
    </script>

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
    echo '    detailContainer.innerHTML = "<img src=\'" + detailData.spot_image + "\' alt=\'" + detailData.spot_name + "の画像\'>" +';
    echo '                               "<div>" +';
    echo '                               "<h2>" + detailData.spot_name + "</h2>" +';
    echo '                               "<p>営業時間: " + detailData.spot_hour + "</p>" +';
    echo '                               "<p>所在地: " + detailData.spot_location + "</p>" +';
    echo '                               "<p>アクセス: " + detailData.spot_access + "</p>" +';
    echo '                               "<p>詳細情報: " + detailData.spot_detail + "</p>" +';
    echo '                               "</div>";';
    echo '}';
    echo '</script>';
    ?>
</body>

</html>
