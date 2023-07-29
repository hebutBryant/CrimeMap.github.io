<?php
$host = "localhost";
$port = "5432";
$dbname = "Crime-Data";
$user = "postgres";
$password = "";

$searchTerm = $_POST['area'];

// 创建数据库连接
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// 检查连接是否成功
if (!$conn) {
    echo "Failed to connect to the database";
    exit;
}

// 准备查询语句
$query = "SELECT DISTINCT ST_AsText(wkb_geometry) AS wkb_geometry_text FROM merged_violent WHERE \"area unit\" = '$searchTerm'";

// 执行查询
$result = pg_query($conn, $query);

if (!$result) {
    echo "Query failed";
    exit;
}

// 处理查询结果
$resultsArray = array();
while ($row = pg_fetch_assoc($result)) {
    // 获取 wkb_geometry 属性值
    $wkbGeometry = $row['wkb_geometry_text'];
    // 在这里可以对 $wkbGeometry 进行进一步的处理
    $resultsArray[] = $wkbGeometry;
}

// 将结果转换为JSON格式
$jsonResult = json_encode($resultsArray);

// 发送JSON响应
header('Content-Type: application/json');
echo $jsonResult;

// 释放结果集和关闭连接
pg_free_result($result);
pg_close($conn);
?>
