<?php
include 'connessione.php';

// Create admin table if it doesn't exist
$conn->query("CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Check if admin user exists, if not create one
$check_admin = $conn->query("SELECT COUNT(*) as count FROM admin");
$admin_count = $check_admin->fetch_assoc()['count'];

if ($admin_count == 0) {
    // Create default admin user
    $username = 'admin';
    $password = password_hash('admin123', PASSWORD_DEFAULT);
    
    $stmt = $conn->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->close();
    
    echo "Admin user created: username = 'admin', password = 'admin123'<br>";
}

// Add missing columns to prenotazioni table
$columns_to_add = [
    'stato' => "ALTER TABLE prenotazioni ADD COLUMN stato ENUM('In attesa', 'Confermata', 'Cancellata') DEFAULT 'In attesa'",
    'email' => "ALTER TABLE prenotazioni ADD COLUMN email VARCHAR(255)",
    'operatore_id' => "ALTER TABLE prenotazioni ADD COLUMN operatore_id INT"
];

foreach ($columns_to_add as $column => $sql) {
    $check_column = $conn->query("SHOW COLUMNS FROM prenotazioni LIKE '$column'");
    if ($check_column->num_rows == 0) {
        $conn->query($sql);
        echo "Added column '$column' to prenotazioni table<br>";
    }
}

// Create operatori table if it doesn't exist
$conn->query("CREATE TABLE IF NOT EXISTS operatori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    cognome VARCHAR(255) NOT NULL,
    telefono VARCHAR(20),
    email VARCHAR(255),
    specialita TEXT,
    attivo TINYINT(1) DEFAULT 1,
    data_inserimento TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Create servizi table if it doesn't exist (for menu items with prices)
$conn->query("CREATE TABLE IF NOT EXISTS servizi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    prezzo DECIMAL(10,2) NOT NULL,
    descrizione TEXT,
    attivo TINYINT(1) DEFAULT 1
)");

// Insert some default menu items if servizi table is empty
$check_servizi = $conn->query("SELECT COUNT(*) as count FROM servizi");
$servizi_count = $check_servizi->fetch_assoc()['count'];

if ($servizi_count == 0) {
    $default_servizi = [
        ['Menu Degustazione Chef', 85.00],
        ['Menu Omakase Premium', 120.00],
        ['Menu Sashimi Selection', 65.00],
        ['Menu Nigiri Tradizionale', 45.00],
        ['Menu Maki & Uramaki', 35.00],
        ['Menu Vegetariano', 40.00],
        ['Menu Bambini', 25.00],
        ['Cena Romantica (2 persone)', 180.00],
        ['Aperitivo Giapponese', 30.00],
        ['Menu Business Lunch', 28.00]
    ];
    
    foreach ($default_servizi as $servizio) {
        $stmt = $conn->prepare("INSERT INTO servizi (nome, prezzo) VALUES (?, ?)");
        $stmt->bind_param("sd", $servizio[0], $servizio[1]);
        $stmt->execute();
        $stmt->close();
    }
    echo "Default menu items added to servizi table<br>";
}

// Create storico_ricavi table if it doesn't exist
$conn->query("CREATE TABLE IF NOT EXISTS storico_ricavi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data DATE NOT NULL UNIQUE,
    ricavo DECIMAL(10,2) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

echo "Database setup completed successfully!<br>";
echo "<a href='index.php'>Go to main site</a> | <a href='login.php'>Go to admin login</a>";

$conn->close();
?>