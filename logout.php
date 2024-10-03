<?PHP
// Rozpoczęcie sesji PHP, aby móc zarządzać danymi sesji użytkownika
session_start();

// Usunięcie wszystkich zmiennych sesji, czyli wylogowanie użytkownika
session_unset();

// Przekierowanie użytkownika na stronę logowania (index.php)
header('location:login.php');
