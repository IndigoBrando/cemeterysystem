<?php
include('config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if it's an admin login
    $sql_admin = "SELECT id, username, first_name, password FROM admins WHERE username=?";
    $stmt_admin = mysqli_prepare($conn, $sql_admin);
    mysqli_stmt_bind_param($stmt_admin, "s", $username);
    mysqli_stmt_execute($stmt_admin);
    $result_admin = mysqli_stmt_get_result($stmt_admin);

    if ($result_admin && mysqli_num_rows($result_admin) > 0) {
        $row_admin = mysqli_fetch_assoc($result_admin);

        if (password_verify($password, $row_admin['password'])) {
            
            $_SESSION['user_id'] = $row_admin['id'];
            $_SESSION['username'] = $row_admin['username'];
            $_SESSION['role'] = 'Manager';
            $_SESSION['first_name'] = $row_admin['first_name']; 

            header("Location: admin/manager_dashboard.php"); 
            exit();
        } else {
            $error_message = "Incorrect password for admin.";
        }
    } else {
        
        $sql_member = "SELECT * FROM members WHERE username=?";
        $stmt_member = mysqli_prepare($conn, $sql_member);
        mysqli_stmt_bind_param($stmt_member, "s", $username);
        mysqli_stmt_execute($stmt_member);
        $result_member = mysqli_stmt_get_result($stmt_member);

        if ($result_member && mysqli_num_rows($result_member) > 0) {
            $row_member = mysqli_fetch_assoc($result_member);

            if (password_verify($password, $row_member['password'])) {
                
                $_SESSION['user_id'] = $row_member['id'];
                $_SESSION['username'] = $row_member['username'];
                $_SESSION['role'] = 'Member';

                header("Location: member/member_dashboard.php"); 
                exit();
            } else {
                $error_message = "Incorrect password for member.";
            }
        } else {
            $error_message = "This member doesn't exist.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Eternal Memorial</title>
    <link href="login.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <div class = "wrapper">
        <form action = "login.php" method="post">
            <h1>Login</h1>
            <div class = "input-box">
                <input type="text" placeholder="Username" id="username" name="username"
                required>
                <i class='bx bxs-user'></i>
            </div>
            <div class = "input-box">
                <input type="password" placeholder="Password" id="password" name="password"
                required>
                <i class='bx bxs-lock-alt' ></i>
            </div>

            <button type="submit" class="btn">Login</button>

            <div class="alert">
                <?php if (isset($error_message)) : ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
            </div>

            
        </form>
        
    </div>

</body>
</html>
