<?php
session_start();
//declare variables
$username = "";
$userPassword = "";

// Check if it is POST request.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get variables from form submission.
    $username = $_POST['username'];
    $userPassword = $_POST['userPassword'];

    // Validate form data.
    try {
        if (!isset($username) || !is_string($username)) {
            throw new Exception("Enter valid username");
        }
        if (!isset($userPassword) || !is_string($userPassword)) {
            throw new Exception("Enter valid password");
        }
    } catch (Exception $e) {
        $message = $e->getMessage();
        die($message);
    }

 //this code for sql server copy    
    // Connect to SQL server
    try {
          $conn = new PDO("sqlsrv:server = tcp:csusm-server.database.windows.net,1433; Database = BLOG_CSUSM", "Citla", "{PASSword1#}");
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        $message = $e->getMessage();
        die($message);
    }
    // SQL Server Extension Sample Code:
    $connectionInfo = array("UID" => "Citla", "pwd" => "{PASSword1#}", "Database" => "BLOG_CSUSM", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
    $serverName = "tcp:csusm-server.database.windows.net,1433";
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    ///up to here 

    $statement= $pdo->prepare("SELECT * FROM Admin WHERE username=:username AND userPassword=:userPassword");
    $statement->execute([
        'username' => $username,
        'userPassword' => $userPassword,
    ]);
    $user = $statement->fetch();
    if(isset($user)){
        $_SESSION['username'] = $user['username'];
        $_SESSION['adminId'] = $user['adminId'];
        header("Location: blog-home.php");
    } else{
        header("Location: loginForm.html");
    }
}
