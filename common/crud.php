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