GNU nano 5.4                                                                                        logout.php                                                                                                 <?php
session_start();
session_destroy();
header("Location: index.php");
exit();
?>











