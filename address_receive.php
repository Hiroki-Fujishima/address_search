<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_POST['id'];
}

$dsn = 'mysql:dbname=sample;host=localhost;charset=utf8';
$user = 'root';
$password = '';

$data = [];

try  {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT id FROM ad_address WHERE id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id,','%'.$id.'%', PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->rowCount();
    while($row = $stmt->fetch(PDO::ERR_ASSOC)) {
        $data[] = $row;
    }
    echo '処理が終了しました。';
} catch (PDOException $e) {
    echo($e->getMessage());
    die();
}
?>
<html>
<body>
<h1>住所検索結果</h1>
<p><?php echo $count;?>件見つかりました。</p>
<table border=1>
    <tr><th>郵便番号</th><th>住所</th></tr>
    <?php foreach($data as $row): ?>
    <tr>
    <td><?php echo $row['id']?></td>
    <td><?php echo $row['ken_name'.'city_name'.'town_name']?></td>
    </tr>
    <?php endforeach; ?>
    </table>
    </body>
    </html>