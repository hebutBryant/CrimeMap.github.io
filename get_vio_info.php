<?php
$host = "localhost";
$port = "5432";
$dbname = "Crime-Data";
$user = "postgres";
$password = "";

$searchTerm = $_POST['select_area'];
$searchTerm2 = $_POST['Type'];

$count = 0;
// 创建数据库连接
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// 检查连接是否成功
if (!$conn) {
echo "Failed to connect to the database";
exit;
}

// 准备查询语句
if ($searchTerm2 === "Violent") {
$query = "SELECT COUNT(*) AS count FROM merged_violent WHERE \"area unit\" = '$searchTerm'";
// 执行查询
    $result = pg_query($conn, $query);

    if (!$result) {
        echo "Query failed";
        exit;
    }

    $row = pg_fetch_assoc($result);
    $count = intval($row['count']);


} else if ($searchTerm2 === "Robbery") {
$query = "SELECT COUNT(*) AS count FROM merged_robbery WHERE \"area unit\" = '$searchTerm'";
// 执行查询
    $result = pg_query($conn, $query);

    if (!$result) {
        echo "Query failed";
        exit;
    }

    $row = pg_fetch_assoc($result);
    $count = intval($row['count']);



}else if($searchTerm2 === "Both Type"){
    $queryViolent = "SELECT COUNT(*) AS count FROM merged_violent WHERE \"area unit\" = '$searchTerm'";
    $queryRobbery = "SELECT COUNT(*) AS count FROM merged_robbery WHERE \"area unit\" = '$searchTerm'";
    $resultViolent = pg_query($conn, $queryViolent);
    $resultRobbery = pg_query($conn, $queryRobbery);

    if (!$resultViolent || !$resultRobbery) {
        echo "Query failed";
        exit;
    }

    $rowViolent = pg_fetch_assoc($resultViolent);
    $rowRobbery = pg_fetch_assoc($resultRobbery);

    $countViolent = intval($rowViolent['count']);
    $countRobbery = intval($rowRobbery['count']);

    $count = $countViolent + $countRobbery;



}
else {
echo "Invalid search term";
exit;
}

//// 执行查询
//$result = pg_query($conn, $query);
//
//if (!$result) {
//echo "Query failed";
//exit;
//}
//
//$row = pg_fetch_assoc($result);
//$count = intval($row['count']);
echo "<h1>Crime Data Search Results</h1>";
echo "<p>The count of area unit '$searchTerm' $searchTerm2 Crime is: $count</p>";



if($searchTerm2 === "Both Type") {
    if ($count <= 10) {
        echo "It is a safe place to live";
    } else if ($count <= 20) {
        echo "Exercise caution, as the area has a moderate crime rate";
    } else {
        echo "The area has a high crime rate. Take necessary precautions.";
    }
}


// 关闭数据库连接
pg_close($conn);
?>
<div>
<a href="Map.html" class="btn btn-primary">Return to Map</a>
</div>

