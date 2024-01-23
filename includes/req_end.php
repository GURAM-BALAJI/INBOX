<?php
$conn = $pdo->open();
try {
    if (isset($_SESSION['vm_id'])) {
        $vm_id = $_SESSION['vm_id'];
        $stmt = $conn->prepare("UPDATE users SET user_semaphore=:semaphore WHERE user_id=:id");
        $stmt->execute(['semaphore' => 0, 'id' => $vm_id]);
    }
} catch (PDOException $e) {
    $_SESSION['error'] = "Something Went Wrong.";
}
$pdo->close();
