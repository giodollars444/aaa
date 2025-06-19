<?php
include 'connessione.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$menu = $_POST['menu'];
$numero_persone = intval($_POST['numero_persone']);
$data = $_POST['data_prenotazione'];
$orario = $_POST['orario'];
$tavolo_preferito = $_POST['tavolo_preferito'];
$note_allergie = $_POST['note_allergie'];
$staff_id = !empty($_POST['staff_id']) ? intval($_POST['staff_id']) : null;

// Check if the selected date is a working day
$day = date('N', strtotime($data)); // 1 = Monday, 7 = Sunday
$dayNames = ['', 'lunedi', 'martedi', 'mercoledi', 'giovedi', 'venerdi', 'sabato', 'domenica'];
$selectedDay = $dayNames[$day];

$working_day_query = $conn->prepare("SELECT attivo FROM giorni_lavorativi WHERE giorno_settimana = ?");
$working_day_query->bind_param("s", $selectedDay);
$working_day_query->execute();
$working_day_result = $working_day_query->get_result();

$isWorkingDay = false;
if ($working_day_result->num_rows > 0) {
    $working_day = $working_day_result->fetch_assoc();
    $isWorkingDay = (bool)$working_day['attivo'];
}

if (!$isWorkingDay) {
    die("
    <!DOCTYPE html>
    <html lang='it'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Errore - AkiraOne</title>
        <link href='https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap' rel='stylesheet'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'>
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body {
                font-family: 'Inter', sans-serif;
                background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f0f23 100%);
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                color: #ffffff;
                padding: 1rem;
            }
            .message-container {
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(20px);
                border-radius: 24px;
                border: 1px solid rgba(239, 68, 68, 0.3);
                padding: 3rem 2.5rem;
                text-align: center;
                max-width: 500px;
                width: 100%;
            }
            .error-icon {
                font-size: 4rem;
                color: #f87171;
                margin-bottom: 1.5rem;
            }
            h1 {
                font-size: 1.8rem;
                font-weight: 700;
                color: #f87171;
                margin-bottom: 1rem;
            }
            p {
                color: #a0a0a0;
                font-size: 1.1rem;
                margin-bottom: 2rem;
                line-height: 1.6;
            }
            .back-btn {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 1rem 2rem;
                background: linear-gradient(135deg, #ff6b6b 0%, #ff8e8e 100%);
                color: #ffffff;
                text-decoration: none;
                border-radius: 12px;
                font-weight: 600;
                transition: all 0.3s ease;
            }
            .back-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 15px 35px -5px rgba(255, 107, 107, 0.4);
            }
            @media (max-width: 480px) {
                .message-container {
                    padding: 2rem 1.5rem;
                }
                h1 {
                    font-size: 1.5rem;
                }
                p {
                    font-size: 1rem;
                }
                .back-btn {
                    padding: 0.8rem 1.5rem;
                    font-size: 0.9rem;
                }
            }
        </style>
    </head>
    <body>
        <div class='message-container'>
            <i class='fas fa-exclamation-triangle error-icon'></i>
            <h1>Ristorante chiuso</h1>
            <p>Il giorno selezionato il ristorante è chiuso. Ti preghiamo di scegliere un altro giorno per la tua prenotazione.</p>
            <a href='index.php' class='back-btn'>
                <i class='fas fa-arrow-left'></i>
                Torna alla prenotazione
            </a>
        </div>
    </body>
    </html>
    ");
}

$working_day_query->close();

// Check if the time slot is active
$time_slot_query = $conn->prepare("SELECT attivo FROM fasce_orarie WHERE orario = ? AND attivo = 1");
$time_slot_query->bind_param("s", $orario);
$time_slot_query->execute();
$time_slot_result = $time_slot_query->get_result();

if ($time_slot_result->num_rows == 0) {
    die("
    <!DOCTYPE html>
    <html lang='it'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Errore - AkiraOne</title>
        <link href='https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap' rel='stylesheet'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'>
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body {
                font-family: 'Inter', sans-serif;
                background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f0f23 100%);
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                color: #ffffff;
                padding: 1rem;
            }
            .message-container {
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(20px);
                border-radius: 24px;
                border: 1px solid rgba(239, 68, 68, 0.3);
                padding: 3rem 2.5rem;
                text-align: center;
                max-width: 500px;
                width: 100%;
            }
            .error-icon {
                font-size: 4rem;
                color: #f87171;
                margin-bottom: 1.5rem;
            }
            h1 {
                font-size: 1.8rem;
                font-weight: 700;
                color: #f87171;
                margin-bottom: 1rem;
            }
            p {
                color: #a0a0a0;
                font-size: 1.1rem;
                margin-bottom: 2rem;
                line-height: 1.6;
            }
            .back-btn {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 1rem 2rem;
                background: linear-gradient(135deg, #ff6b6b 0%, #ff8e8e 100%);
                color: #ffffff;
                text-decoration: none;
                border-radius: 12px;
                font-weight: 600;
                transition: all 0.3s ease;
            }
            .back-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 15px 35px -5px rgba(255, 107, 107, 0.4);
            }
            @media (max-width: 480px) {
                .message-container {
                    padding: 2rem 1.5rem;
                }
                h1 {
                    font-size: 1.5rem;
                }
                p {
                    font-size: 1rem;
                }
                .back-btn {
                    padding: 0.8rem 1.5rem;
                    font-size: 0.9rem;
                }
            }
        </style>
    </head>
    <body>
        <div class='message-container'>
            <i class='fas fa-exclamation-triangle error-icon'></i>
            <h1>Orario non disponibile</h1>
            <p>L'orario selezionato non è disponibile. Ti preghiamo di scegliere un altro orario per la tua prenotazione.</p>
            <a href='index.php' class='back-btn'>
                <i class='fas fa-arrow-left'></i>
                Torna alla prenotazione
            </a>
        </div>
    </body>
    </html>
    ");
}

$time_slot_query->close();

// Check availability before inserting
$specific_limit_query = $conn->prepare("SELECT limite_persone FROM limiti_date_specifiche WHERE data_specifica = ? AND orario = ? AND attivo = 1");
$specific_limit_query->bind_param("ss", $data, $orario);
$specific_limit_query->execute();
$specific_limit_result = $specific_limit_query->get_result();

$limit = null;

if ($specific_limit_result->num_rows > 0) {
    $specific_limit_row = $specific_limit_result->fetch_assoc();
    $limit = $specific_limit_row['limite_persone'];
} else {
    $general_limit_query = $conn->prepare("SELECT limite_persone FROM limiti_orari WHERE giorno_settimana = ? AND orario = ? AND attivo = 1");
    $general_limit_query->bind_param("ss", $selectedDay, $orario);
    $general_limit_query->execute();
    $general_limit_result = $general_limit_query->get_result();
    
    if ($general_limit_result->num_rows > 0) {
        $general_limit_row = $general_limit_result->fetch_assoc();
        $limit = $general_limit_row['limite_persone'];
    }
    $general_limit_query->close();
}

if ($limit !== null) {
    $booking_query = $conn->prepare("SELECT COUNT(*) as count FROM prenotazioni WHERE data_prenotazione = ? AND orario = ? AND (stato IS NULL OR stato != 'Cancellata')");
    $booking_query->bind_param("ss", $data, $orario);
    $booking_query->execute();
    $booking_result = $booking_query->get_result();
    $booking_row = $booking_result->fetch_assoc();
    $current_bookings = $booking_row['count'];

    if ($current_bookings >= $limit) {
        die("
        <!DOCTYPE html>
        <html lang='it'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Errore - AkiraOne</title>
            <link href='https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap' rel='stylesheet'>
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'>
            <style>
                * { margin: 0; padding: 0; box-sizing: border-box; }
                body {
                    font-family: 'Inter', sans-serif;
                    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f0f23 100%);
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    min-height: 100vh;
                    color: #ffffff;
                    padding: 1rem;
                }
                .message-container {
                    background: rgba(255, 255, 255, 0.05);
                    backdrop-filter: blur(20px);
                    border-radius: 24px;
                    border: 1px solid rgba(239, 68, 68, 0.3);
                    padding: 3rem 2.5rem;
                    text-align: center;
                    max-width: 500px;
                    width: 100%;
                }
                .error-icon {
                    font-size: 4rem;
                    color: #f87171;
                    margin-bottom: 1.5rem;
                }
                h1 {
                    font-size: 1.8rem;
                    font-weight: 700;
                    color: #f87171;
                    margin-bottom: 1rem;
                }
                p {
                    color: #a0a0a0;
                    font-size: 1.1rem;
                    margin-bottom: 2rem;
                    line-height: 1.6;
                }
                .back-btn {
                    display: inline-flex;
                    align-items: center;
                    gap: 0.5rem;
                    padding: 1rem 2rem;
                    background: linear-gradient(135deg, #ff6b6b 0%, #ff8e8e 100%);
                    color: #ffffff;
                    text-decoration: none;
                    border-radius: 12px;
                    font-weight: 600;
                    transition: all 0.3s ease;
                }
                .back-btn:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 15px 35px -5px rgba(255, 107, 107, 0.4);
                }
                @media (max-width: 480px) {
                    .message-container {
                        padding: 2rem 1.5rem;
                    }
                    h1 {
                        font-size: 1.5rem;
                    }
                    p {
                        font-size: 1rem;
                    }
                    .back-btn {
                        padding: 0.8rem 1.5rem;
                        font-size: 0.9rem;
                    }
                }
            </style>
        </head>
        <body>
            <div class='message-container'>
                <i class='fas fa-exclamation-triangle error-icon'></i>
                <h1>Orario completo</h1>
                <p>L'orario selezionato ha raggiunto il limite massimo di prenotazioni ($current_bookings/$limit). Ti preghiamo di scegliere un altro orario.</p>
                <a href='index.php' class='back-btn'>
                    <i class='fas fa-arrow-left'></i>
                    Torna alla prenotazione
                </a>
            </div>
        </body>
        </html>
        ");
    }
    $booking_query->close();
}

$stmt = $conn->prepare("INSERT INTO prenotazioni (nome, email, telefono, menu, numero_persone, data_prenotazione, orario, tavolo_preferito, note_allergie, staff_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssi", $nome, $email, $telefono, $menu, $numero_persone, $data, $orario, $tavolo_preferito, $note_allergie, $staff_id);

if ($stmt->execute()) {
    $success = true;
    $staff_name = '';
    if ($staff_id) {
        $staff_query = $conn->prepare("SELECT nome, cognome FROM staff WHERE id = ?");
        $staff_query->bind_param("i", $staff_id);
        $staff_query->execute();
        $staff_result = $staff_query->get_result();
        if ($staff_result->num_rows > 0) {
            $staff_row = $staff_result->fetch_assoc();
            $staff_name = $staff_row['nome'] . ' ' . $staff_row['cognome'];
        }
        $staff_query->close();
    }
} else {
    $success = false;
}

$stmt->close();
$specific_limit_query->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $success ? 'Prenotazione Confermata' : 'Errore Prenotazione'; ?> - AkiraOne</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f0f23 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #ffffff;
            overflow-x: hidden;
            padding: 1rem;
        }

        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.1;
        }

        .bg-animation::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ff6b6b' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .message-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid <?php echo $success ? 'rgba(34, 197, 94, 0.3)' : 'rgba(239, 68, 68, 0.3)'; ?>;
            padding: 3rem 2.5rem;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            text-align: center;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message-icon {
            font-size: 4rem;
            color: <?php echo $success ? '#4ade80' : '#f87171'; ?>;
            margin-bottom: 1.5rem;
            animation: bounce 1s ease-in-out;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

        .message-title {
            font-size: 2rem;
            font-weight: 700;
            color: <?php echo $success ? '#4ade80' : '#f87171'; ?>;
            margin-bottom: 1rem;
        }

        .message-text {
            color: #a0a0a0;
            font-size: 1.1rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .booking-details {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 1.5rem;
            margin: 2rem 0;
            text-align: left;
        }

        .booking-details h3 {
            color: #ff6b6b;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            text-align: center;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: #a0a0a0;
            font-weight: 500;
        }

        .detail-value {
            color: #ffffff;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #ff6b6b 0%, #ff8e8e 100%);
            color: #ffffff;
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.3);
        }

        .btn-primary:hover {
            box-shadow: 0 15px 35px -5px rgba(255, 107, 107, 0.4);
        }

        @media (max-width: 768px) {
            .message-container {
                padding: 2rem 1.5rem;
                max-width: 100%;
            }

            .message-title {
                font-size: 1.6rem;
            }

            .message-text {
                font-size: 1rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .detail-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.3rem;
            }
        }

        @media (max-width: 480px) {
            .message-container {
                padding: 1.5rem 1rem;
            }

            .message-title {
                font-size: 1.4rem;
            }

            .message-text {
                font-size: 0.95rem;
            }

            .message-icon {
                font-size: 3rem;
            }

            .booking-details {
                padding: 1rem;
            }

            .booking-details h3 {
                font-size: 1rem;
            }

            .btn {
                padding: 0.8rem 1.5rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="bg-animation"></div>

    <div class="message-container">
        <?php if ($success): ?>
            <i class="fas fa-check-circle message-icon"></i>
            <h1 class="message-title">Prenotazione Confermata!</h1>
            <p class="message-text">
                La tua prenotazione è stata registrata con successo. Ti aspettiamo da AkiraOne per un'esperienza culinaria indimenticabile!
            </p>

            <div class="booking-details">
                <h3><i class="fas fa-calendar-check"></i> Dettagli Prenotazione</h3>
                <div class="detail-row">
                    <span class="detail-label">Nome:</span>
                    <span class="detail-value"><?php echo htmlspecialchars($nome); ?></span>
                </div>
                <?php if ($email): ?>
                <div class="detail-row">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value"><?php echo htmlspecialchars($email); ?></span>
                </div>
                <?php endif; ?>
                <?php if ($telefono): ?>
                <div class="detail-row">
                    <span class="detail-label">Telefono:</span>
                    <span class="detail-value"><?php echo htmlspecialchars($telefono); ?></span>
                </div>
                <?php endif; ?>
                <div class="detail-row">
                    <span class="detail-label">Persone:</span>
                    <span class="detail-value"><?php echo $numero_persone; ?></span>
                </div>
                <?php if ($menu): ?>
                <div class="detail-row">
                    <span class="detail-label">Menu:</span>
                    <span class="detail-value"><?php echo htmlspecialchars($menu); ?></span>
                </div>
                <?php endif; ?>
                <div class="detail-row">
                    <span class="detail-label">Data:</span>
                    <span class="detail-value"><?php echo date('d/m/Y', strtotime($data)); ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Orario:</span>
                    <span class="detail-value"><?php echo date('H:i', strtotime($orario)); ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Tavolo:</span>
                    <span class="detail-value"><?php echo ucfirst(str_replace('_', ' ', $tavolo_preferito)); ?></span>
                </div>
                <?php if ($staff_name): ?>
                <div class="detail-row">
                    <span class="detail-label">Staff:</span>
                    <span class="detail-value"><?php echo htmlspecialchars($staff_name); ?></span>
                </div>
                <?php endif; ?>
                <?php if ($note_allergie): ?>
                <div class="detail-row">
                    <span class="detail-label">Note:</span>
                    <span class="detail-value"><?php echo htmlspecialchars($note_allergie); ?></span>
                </div>
                <?php endif; ?>
            </div>

            <div class="action-buttons">
                <a href="index.php" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Nuova Prenotazione
                </a>
                <a href="index.php" class="btn btn-secondary">
                    <i class="fas fa-home"></i>
                    Torna alla Home
                </a>
            </div>

        <?php else: ?>
            <i class="fas fa-exclamation-triangle message-icon"></i>
            <h1 class="message-title">Errore nella Prenotazione</h1>
            <p class="message-text">
                Si è verificato un errore durante la registrazione della tua prenotazione. Ti preghiamo di riprovare.
            </p>

            <div class="action-buttons">
                <a href="index.php" class="btn btn-primary">
                    <i class="fas fa-redo"></i>
                    Riprova
                </a>
                <a href="index.php" class="btn btn-secondary">
                    <i class="fas fa-home"></i>
                    Torna alla Home
                </a>
            </div>
        <?php endif; ?>
    </div>

    <script>
        <?php if ($success): ?>
        setTimeout(() => {
            window.location.href = 'index.php';
        }, 15000);
        <?php endif; ?>

        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                btn.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    btn.style.transform = '';
                }, 150);
            });
        });

        if ('ontouchstart' in window) {
            document.body.classList.add('touch-device');
        }

        function setViewportHeight() {
            const vh = window.innerHeight * 0.01;
            document.documentElement.style.setProperty('--vh', `${vh}px`);
        }

        setViewportHeight();
        window.addEventListener('resize', setViewportHeight);
        window.addEventListener('orientationchange', () => {
            setTimeout(setViewportHeight, 100);
        });
    </script>
</body>
</html>