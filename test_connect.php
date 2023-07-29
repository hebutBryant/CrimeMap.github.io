<?php
$host = "localhost"; // 数据库主机名
$port = "5432"; // 数据库端口号
$dbname = "test2"; // 数据库名称
$user = "postgres"; // 数据库用户名
$password = ""; // 数据库密码


try {
    // 创建数据库连接
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

    // 准备查询语句
    $statement = $pdo->prepare('SELECT * FROM joinedauckland WHERE "area unit" = :areaUnit');

    // 绑定参数并执行查询
    $areaUnit = 'Albany';
    $statement->bindParam(':areaUnit', $areaUnit);
    $statement->execute();

    // 获取查询结果
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        // 处理每一行记录
        echo $row['area unit'] . ' ' . $row['au2017_nam'] . '<br>';
    }
} catch (PDOException $e) {
    echo "数据库连接错误: " . $e->getMessage();
}

