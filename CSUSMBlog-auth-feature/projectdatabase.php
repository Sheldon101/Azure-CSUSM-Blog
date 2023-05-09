<?php
try
{
  $conn = new PDO("sqlsrv:server = tcp:csusm-server.database.windows.net,1433; Database = BLOG_CSUSM", "Citla", "{PASSword1#}");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e )
{
  die($e->getMessage());
}
// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "Citla", "pwd" => "{PASSword1#}", "Database" => "BLOG_CSUSM", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:csusm-server.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

 echo "Connection Established\n";

  // This is for verifying the passed information where the passed information is username and userPassword
  $resultAdmin = $pdo->query("SELECT adminId FROM Admin WHERE username = 'CSUSM' && userPassword = '123654';");

  // Because we are grabbing ONLY the primary key,
  // there is no while loop necessary
  echo $resultAdmin->fetch()["adminId"] . "<br/>";


  // This one needs a while loop as it will select multiple rows
  $homePost = $pdo->query("SELECT * FROM Post;");

  while($result = $homePost->fetch()) // While there are posts to fetch
  {
    // Perform functions that read all the data and create a proper barrier for them
    $title = $result["title"];
    echo $title . "<br/>";

    $subtitle = $result["subtitle"];
    echo $subtitle . "<br/>";

    $content = $result["content"];
    echo $content . "<br/>";

    $createdAt = $result["createdAt"];
    echo $createdAt . "<br/>";

    $updatedAt = $result["updatedAt"];
    echo $updatedAt . "<br/>";

    $thumbnail = $result["thumbnail"];
    echo $thumbnail . "<br/>";
  }
  // This query grabs all values in the row that has the postID called
  $articlePost = $pdo->query("SELECT * FROM Post WHERE postID = '1001';");

  $articleResult = $articlePost->fetch();
  // Perform functions that read all the data and create a proper barrier for them
  $articleTitle = $articleResult["title"];
  echo $articleTitle . "<br/>";

  $articlesubtitle = $articleResult["subtitle"];
  echo $articleSubtitle . "<br/>";

  $articleContent = $articleResult["content"];
  echo $articleContent . "<br/>";

  $articleCreatedAt = $articleResult["createdAt"];
  echo $articleCreatedAt . "<br/>";

  $articleUpdatedAt = $articleResult["updatedAt"];
  echo $articleUpdatedAt . "<br/>";

  $articleThumbnail = $articleResult["thumbnail"];
  echo $articleThumbnail . "<br/>";
?>
