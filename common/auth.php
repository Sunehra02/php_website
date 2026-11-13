<?php
session_start();

function is_logged_in() { return isset($_SESSION["user_id"]); }
function is_admin() { return ($_SESSION["role"] ?? "") === "admin"; }

function require_login() {
  if (!is_logged_in()) { header("Location: login.php"); exit; }
}

function require_admin() {
  require_login();
  if (!is_admin()) { http_response_code(403); die("Access denied. Admins only."); }
}