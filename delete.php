<?php
// id iletildi mi?
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // id'si iletilen kullanıcıyı veritabanından sil.
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$userId]);

    // Kullanıcının silindiği bilgisin verileceği sayfaya yönlendirme yap.
    header('Location: index.php?page=info2');
    exit;
} else {
    // id iletilmedi ise ilk admin sayfasına geri dönmesi için yönlendirme yap.
    header('Location: index.php?page=admin');
    exit;
}
?>