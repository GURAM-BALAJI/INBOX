<?php
$conn = $pdo->open();
try {
    if (isset($_SESSION['vm_user'])) {
        $vm_id = $_SESSION['vm_id'];
        $stmtreq = $conn->prepare("SELECT user_semaphore FROM users WHERE user_id = :vm_id");
        $stmtreq->execute(['vm_id' => $vm_id]);
        foreach ($stmtreq as $rowreq) {
            if ($rowreq['user_semaphore'] == 0) {
                $stmt = $conn->prepare("UPDATE users SET user_semaphore=:user_semaphore WHERE user_id=:id");
                $stmt->execute(['user_semaphore' => 1, 'id' => $vm_id]);
                $req_per = 1;
            } else {
                $req_per = 0;
            }
        }
    }else{
        header('location:LogMe');
        exit();
    }
} catch (PDOException $e) {
    $_SESSION['error'] = "Something Went Wrong.";
}

$pdo->close();
