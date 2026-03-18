<?php
session_start();
require_once 'config-database.php';
require_once 'includes-security.php';

// If already logged in, redirect to homepage
if (isLoggedIn()) {
    header("Location: index.php");  
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    
    $username = sanitizeInput($_POST['username']);
    $password = $_POST['password'];
    
    // Query user
    $query = "SELECT u.*, p.ProfID, p.FName, p.LName 
              FROM users u 
              LEFT JOIN professors p ON u.ProfID = p.ProfID 
              WHERE u.Username = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        // Check password against database (plain text comparison)
        if ($password === $user['PasswordHash']) {
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['username'] = $user['Username'];
            $_SESSION['role'] = $user['Role'];
            $_SESSION['prof_id'] = $user['ProfID'];
            $_SESSION['name'] = $user['FName'] . ' ' . $user['LName'];
            
            header("Location: index.php");  
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>

<?php include 'includes-header.php'; ?>  

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Hogwarts School Login</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <form method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                    
                    <div class="mt-3">
                        <h6>Demo Accounts:</h6>
                        <ul class="small">
                            <li><strong>Admin:</strong> admin / admin123</li>
                            <li><strong>Teachers:</strong> [username] / teacher123</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'includes-footer.php'; ?>