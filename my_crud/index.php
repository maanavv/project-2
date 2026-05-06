<?php
// --- 1. DATABASE CONNECTION ---
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "crud_db";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("<div class='alert alert-danger'>Connection failed: " . mysqli_connect_error() . "</div>");
}

// --- 2. HANDLE INSERT (CREATE) ---
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    if (!empty($name) && !empty($email)) {
        $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
        if (mysqli_query($conn, $sql)) {
            header("Location: index.php?msg=User added successfully!&type=success");
            exit();
        }
    }
}

// --- 3. HANDLE DELETE (DELETE) ---
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']); // intval for basic security
    $sql = "DELETE FROM users WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php?msg=User deleted successfully!&type=danger");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Master CRUD</title>
    <!-- Bootstrap 5 for Modern UI -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --primary-color: #4e73df; --bg-color: #f8f9fc; }
        body { background-color: var(--bg-color); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar { background: linear-gradient(90deg, #4e73df 0%, #224abe 100%); box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .card { border: none; border-radius: 12px; transition: transform 0.2s; }
        .card:hover { transform: translateY(-5px); }
        .btn-primary { background-color: var(--primary-color); border: none; }
        .table thead { background-color: #4e73df; color: white; }
        .badge-id { background-color: #eaecf4; color: #4e73df; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark mb-5">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">🚀 User Management System</a>
    </div>
</nav>

<div class="container">
    <!-- Success/Delete Notifications -->
    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-<?php echo $_GET['type']; ?> alert-dismissible fade show shadow-sm" role="alert">
            <strong>Notice:</strong> <?php echo $_GET['msg']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <!-- Input Column -->
        <div class="col-lg-4">
            <div class="card shadow p-4">
                <h4 class="fw-bold text-dark mb-4">Add New Entry</h4>
                <form action="index.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-bold">FULL NAME</label>
                        <input type="text" name="name" class="form-control form-control-lg" placeholder="John Wick" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-secondary small fw-bold">EMAIL ADDRESS</label>
                        <input type="email" name="email" class="form-control form-control-lg" placeholder="john@continental.com" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-lg w-100 fw-bold">Save Record</button>
                </form>
            </div>
        </div>

        <!-- Display Column -->
        <div class="col-lg-8">
            <div class="card shadow p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold text-dark m-0">Database Records</h4>
                    <span class="badge bg-primary px-3 py-2">Real-time Data</span>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th class="border-0">ID</th>
                                <th class="border-0">User Info</th>
                                <th class="border-0 text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM users ORDER BY id DESC";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><span class="badge badge-id">#<?php echo $row['id']; ?></span></td>
                                        <td>
                                            <div class="fw-bold text-dark"><?php echo $row['name']; ?></div>
                                            <div class="small text-muted"><?php echo $row['email']; ?></div>
                                        </td>
                                        <td class="text-end">
                                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary px-3 me-1">Edit</a>
                                            <a href="index.php?delete=<?php echo $row['id']; ?>" 
                                               class="btn btn-sm btn-outline-danger px-3"
                                               onclick="return confirm('Wait! Are you sure you want to delete this user?')">Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='3' class='text-center py-4 text-muted'>No users found. Start by adding one!</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS for Animations -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>