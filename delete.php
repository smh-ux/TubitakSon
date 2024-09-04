<?php

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM kullanicilar WHERE KullaniciID = ?");
    $stmt->execute([$userId]);

    header('Location: index.php?page=info2');
    exit;
} else {
    header('Location: index.php?page=admin');
    exit;
}

?>