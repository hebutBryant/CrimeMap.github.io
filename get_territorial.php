<?php
$host = "localhost";
$port = "5432";
$dbname = "Crime-Data";
$user = "postgres";
$password = "";

$searchTerm = $_POST['region'];
// 创建数据库连接
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// 检查连接是否成功
if (!$conn) {
echo json_encode(array("error" => "Failed to connect to the database"));
exit;
}

$query = "SELECT DISTINCT \"ta2014 nam\" FROM merged_violent WHERE \"region\" = '$searchTerm'";
$result = pg_query($conn, $query);

// 检查查询结果
if (!$result) {
echo json_encode(array("error" => "Query execution failed"));
exit;
}

$options = array();
while ($row = pg_fetch_assoc($result)) {
$options[] = $row["ta2014 nam"];
}

// 释放结果集和关闭连接
pg_free_result($result);
pg_close($conn);

// 构造响应数据
$response = array("options" => $options);

// 将结果转换为 JSON 格式并发送响应
echo json_encode($response);
