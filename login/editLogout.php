<?php
echo 'Successfully edited information. Please Re-logging.';
session_start();
session_destroy();
// Redirect to the login page:
header('refresh:2; url=../login/index.html');
?>