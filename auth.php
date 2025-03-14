$db_host = "localhost";
$db_user = "webuser";
$db_pass = "your_secure_password";
$db_name = "user_auth";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function registerUser($email, $password, $conn) {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO users (email, password_hash) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $hashed_password);
    return $stmt->execute();
}

function loginUser($email, $password, $conn) {
    $stmt = $conn->prepare("SELECT password_hash FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        return password_verify($password, $hashed_password);
    }
    return false;
}
?>



