<?php
// 1. Koneksyon ak baz de done
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bras_haiti";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksyon echwe: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass_input = $_POST['password'];

    // 2. Ankripte modpas la pou sekirite
    $hashed_password = password_hash($pass_input, PASSWORD_DEFAULT);

    // 3. Mete enfòmasyon yo nan baz la
    $sql = "INSERT INTO utilisateurs (email, password) VALUES ('$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Kont ou kreye ak siksè!'); window.location.href='index.html';</script>";
    } else {
        if ($conn->errno == 1062) { // Erè si imèl la te deja egziste
            echo "<script>alert('Erè: Imèl sa a gen yon kont deja!'); window.history.back();</script>";
        } else {
            echo "Erè: " . $conn->error;
        }
    }
}
$conn->close();
?>
