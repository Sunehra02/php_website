<?php
$conn = mysqli_connect("localhost", "root", "", "portfolio_db");
if (!$conn) {
  die("Database connection failed: " . mysqli_connect_error());}
function db_query($sql, $types = "", $params = []) {
  global $conn;
  $stmt = mysqli_prepare($conn, $sql);
  if ($types) mysqli_stmt_bind_param($stmt, $types, ...$params);
  mysqli_stmt_execute($stmt);
  return $stmt;}
// Create
function create_contact($name, $phone, $email, $address, $github, $linkedin) {
  db_query("INSERT INTO contacts (name, phone, email, address, github, linkedin) VALUES (?, ?, ?, ?, ?, ?)",
    "ssssss", [$name, $phone, $email, $address, $github, $linkedin]);}
// Read: all contacts
function get_contacts() {
  return mysqli_fetch_all(mysqli_stmt_get_result(db_query("SELECT * FROM contacts ORDER BY id DESC")), MYSQLI_ASSOC);}
// Read: one contact
function get_contact($id) {
  return mysqli_fetch_assoc(mysqli_stmt_get_result(db_query("SELECT * FROM contacts WHERE id = ?", "i", [$id])));
}
// Update
function update_contact($id, $name, $phone, $email, $address, $github, $linkedin) {
  db_query("UPDATE contacts SET name = ?, phone = ?, email = ?, address = ?, github = ?, linkedin = ? WHERE id = ?",
    "ssssssi", [$name, $phone, $email, $address, $github, $linkedin, $id]);
}
// Delete
function delete_contact($id) {
  db_query("DELETE FROM contacts WHERE id = ?", "i", [$id]);
}

// Users
function get_user_by_email($email) {
  return mysqli_fetch_assoc(mysqli_stmt_get_result(db_query("SELECT * FROM users WHERE email = ?", "s", [$email])));
}

function toggle_viewed($id) {
  db_query("UPDATE contacts SET viewed = 1 - viewed WHERE id = ?", "i", [$id]);
}

function create_user($name, $email, $password, $role) {
  db_query("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)",
    "ssss", [$name, $email, password_hash($password, PASSWORD_DEFAULT), $role]);
}
// Admin projects
function create_admin_project($title, $description, $file, $type) {
  db_query("INSERT INTO admin_projects (title, description, file, type) VALUES (?, ?, ?, ?)",
    "ssss", [$title, $description, $file, $type]);
}

function get_admin_projects() {
  return mysqli_fetch_all(mysqli_stmt_get_result(db_query("SELECT * FROM admin_projects ORDER BY created_at DESC")), MYSQLI_ASSOC);
}

function get_admin_project($id) {
  return mysqli_fetch_assoc(mysqli_stmt_get_result(db_query("SELECT * FROM admin_projects WHERE id = ?", "i", [$id])));
}

function update_admin_project($id, $title, $description, $file, $type) {
  db_query("UPDATE admin_projects SET title = ?, description = ?, file = ?, type = ?, updated_at = NOW() WHERE id = ?",
    "ssssi", [$title, $description, $file, $type, $id]);
}

function delete_admin_project($id) {
  db_query("DELETE FROM admin_projects WHERE id = ?", "i", [$id]);
}