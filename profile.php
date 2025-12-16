<?php
require ("includes/common.php");
session_start();
if (!isset($_SESSION['email'])) {
    header('location: index.php');
    exit;
}
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - SkinCare Shop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'includes/header_menu.php'; ?>

<div class="container mt-5 mb-5">
    <h1 class="mb-4"><i class="fas fa-user-circle"></i> My Profile</h1>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="change_profile.php" method="POST">
                        <input type="hidden" value="<?php echo $user_id; ?>" name="id">
                        
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['name']); ?>" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>" name="phone">
                        </div>
                        
                        <div class="form-group">
                            <label>New Password (leave blank to keep current)</label>
                            <input type="password" class="form-control" name="pass" placeholder="Enter new password">
                        </div>
                        
                        <button type="submit" class="btn btn-olive text-white">
                            <i class="fas fa-save"></i> Update Profile
                        </button>
                        <a href="index.php" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-user-circle" style="font-size: 80px; color: #3C4226;"></i>
                    <h4 class="mt-3"><?php echo htmlspecialchars($user['name']); ?></h4>
                    <p class="text-muted"><?php echo htmlspecialchars($user['email']); ?></p>
                    <hr>
                    <p><strong>Role:</strong> <?php echo ucfirst($user['role']); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>