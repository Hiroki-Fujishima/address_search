<?php 
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
}
?>
<html>
<head>
<meta charset="UTF-8">
<title>住所検索アプリ</title>
</head>
<body>
<h1>住所検索アプリ</h1>
<p>住所を検索してください</p>
<form action="u2.php" method="POST">
<label>郵便番号</label>
<input type= "int" id="id" >
<input type="submit" value="検索する">
</form>
</body>
</html>