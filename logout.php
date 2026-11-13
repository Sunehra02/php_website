<?php
require_once 'common/auth.php';
$_SESSION = [];
session_destroy();
header("Location: login.php");
exit;