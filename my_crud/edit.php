<?php 
// --- 1. DATABASE CONNECTION ---
$conn = mysqli_connect("localhost", "root", "", "crud_db");

// --- 2. FETCH EXISTING DATA ---
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $record = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
    $data = mysqli_fetch_assoc($record);
}

// --- 3. HANDLE UPDATE ---
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php?msg=User updated successfully&type=info");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --primary-color: #4e73df; --bg-color: #f8f9fc; }
        body { background-color: var(--bg-color); font-family: 'Segoe UI', sans-serif; }
        .navbar { background: linear-gradient(90deg, #4e73df 0%, #224abe 100%); }
        .card { border: none; border-radius: 12px; }
        .btn-primary { background-color: var(--primary-color); border: none; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark mb-5 shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">⬅ Back to Dashboard</a>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow p-4">
                <h4 class="fw-bold text-dark mb-4">Edit User Details</h4>
                <form method="POST" action="edit.php">
                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                    
                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-bold">FULL NAME</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $data['name']; ?>" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-secondary small fw-bold">EMAIL ADDRESS</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>" required>
                    </div>
                    
                    <button type="submit" name="update" class="btn btn-primary btn-lg w-100 fw-bold">Update Record</button>
                    <a href="index.php" class="btn btn-link w-100 mt-2 text-secondary text-decoration-none">Cancel Changes</a>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>