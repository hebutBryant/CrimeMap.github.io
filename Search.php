<?php
$host = "localhost";
$port = "5432";
$dbname = "test2";
$user = "postgres";
$password = "";

$searchTerm = $_POST['city'];

// 创建数据库连接
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// 检查连接是否成功
if (!$conn) {
    echo "Failed to connect to the database";
    exit;
}

// 执行查询
$query = "SELECT DISTINCT \"area unit\" FROM joinedAuckland WHERE \"region\" = '$searchTerm'";
$result = pg_query($conn, $query);

if (!$result) {
    echo "Query failed";
    exit;
}

// 构建结果数组
$options = array();
while ($row = pg_fetch_assoc($result)) {
    $options[] = $row['area unit'];
}

// 输出查询结果作为 JSON
echo json_encode($options);

// 释放结果集和关闭连接
pg_free_result($result);
pg_close($conn);
?>
