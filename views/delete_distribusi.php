<?php
include_once '../controllers/crud_distribusi.php';  // Include the DistribusiController
include_once '../config/koneksi.php';  // Include database connection

// Create an instance of Koneksi to get the database connection
$koneksi = new Koneksi();
$conn = $koneksi->getConnection();

// Create an instance of DistribusiController
$distribusiController = new DistribusiController();  // Move this outside the condition to avoid undefined variable

// Check if the ID is provided in the URL
if (isset($_GET['id_distribusi'])) {
    $id = $_GET['id_distribusi'];  // Get the ID from the URL
    $distribusi = $distribusiController->readOne($id);  // Fetch the distribusi record by ID
} else {
    // If no ID is provided, handle the case here (e.g., redirect, show error, etc.)
    echo "No ID provided!";
    exit;
}

// Check if the delete form has been submitted
if (isset($_POST['confirm_delete'])) {
    // Call the deleteAndRestore method from DistribusiController
    $distribusiController->deleteAndRestore($id, $conn);  // Pass the ID and DB connection
    header("Location: ../Views/distribusi.php");  // Redirect to the list of distribusi records after deletion
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../views/style/delete.css">
    <title>Confirm Deletion</title>
    <style>
        /* Basic styling for confirmation container */
        .confirmation-container {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            margin: 50px auto;
            text-align: center;
            opacity: 0; /* Start hidden */
            transform: translateY(-30px); /* Start slightly above */
            animation: slideIn 0.8s ease-out forwards; /* Apply animation */
        }

        /* Animation for sliding in and fading in */
        @keyframes slideIn {
            0% {
                opacity: 0;
                transform: translateY(-30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Styling for the title */
        h2 {
            font-size: 22px;
            color: #333;
            margin-bottom: 20px;
        }

        .hp-details {
            margin-top: 20px;
            text-align: left;
        }

        .hp-details p {
            font-size: 16px;
            margin: 5px 0;
            color: #555;
        }

        .hp-details strong {
            color: #333;
        }

        /* Button styling */
        button {
            padding: 10px 20px;
            margin-top: 20px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            width: 100%;
        }

        button[type="button"] {
            background-color: rgb(54, 152, 244);
            color: white;
        }

        button[type="submit"] {
            background-color: #f44336;
            color: white;
        }

        button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

    <div class="confirmation-container">
        <h2>Apa anda yakin ingin mengembalikan data ini?</h2>

        <div class="hp-details">
            <p><strong>Nama hp</strong> <?= htmlspecialchars($distribusi['nama_hp']) ?></p>
            <p><strong>Stok:</strong> <?= htmlspecialchars($distribusi['stok']) ?></p>
            <p><strong>Harga:</strong> <?= htmlspecialchars($distribusi['harga']) ?></p>
            <p><strong>Id toko:</strong> <?= htmlspecialchars($distribusi['id_toko']) ?></p>
            <p><strong>Tanggal kirim:</strong> <?= htmlspecialchars($distribusi['tanggal_kirim']) ?></p>
        </div>

        <form method="POST" action="">
            <button type="button" onclick="window.location.href='../Views/distribusi.php';">Batal</button>
            <button type="submit" name="confirm_delete">Ya, hapus</button>
        </form>
    </div>

</body>
</html>
