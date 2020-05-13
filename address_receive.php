<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $_POST['zip'];
}

$dsn = 'mysql:dbname=sample;host=localhost;charset=utf8';
$user = 'root';
$password = '';

$data = [];

try  {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT ken_name, zip, city_name, town_name, block_name FROM ad_address WHERE zip LIKE :name";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':name','%'.$name.'%', PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->rowCount();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
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
    <td><?php echo $row['zip'];?></td>
    <td><?php echo $row['ken_name'];?>
    <?php echo $row['city_name'];?>
    <?php echo $row['town_name'];?>
    <?php echo $row['block_name'];?>
    </td>
    </tr>
    <?php endforeach; ?>
    </table>
    </body>
    </html>