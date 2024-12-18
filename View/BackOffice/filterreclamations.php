<?php
if (isset($_GET['status'])) {
    $status = $_GET['status'];

    if ($status === 'Closed') {
        header('Location: reclamationlistclosed.php');
        exit;
    } elseif ($status === 'Open') {
        header('Location: reclamationlistopen.php');
        exit;
    }
} else {
    echo "Please select a status to filter.";
}
?>
