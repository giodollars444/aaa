<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AkiraOne - Ristorante Sushi Giapponese</title>
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
            min-height: 100vh;
            color: #ffffff;
            overflow-x: hidden;
        }

        /* Background Animation */
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

        /* Header */
        .header {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo i {
            font-size: 2.5rem;
            color: #ff6b6b;
            filter: drop-shadow(0 0 10px rgba(255, 107, 107, 0.3));
        }

        .logo h1 {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #ff6b6b 0%, #ff8e8e 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-links a {
            color: #a0a0a0;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 8px;
        }

        .nav-links a:hover {
            color: #ff6b6b;
            background: rgba(255, 107, 107, 0.1);
        }

        /* Main Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: start;
        }

        /* Hero Section */
        .hero {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 3rem;
            text-align: center;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .hero-icon {
            font-size: 4rem;
            color: #ff6b6b;
            margin-bottom: 1.5rem;
            filter: drop-shadow(0 0 20px rgba(255, 107, 107, 0.3));
        }

        .hero h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #ffffff 0%, #ff6b6b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero p {
            font-size: 1.2rem;
            color: #a0a0a0;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .feature {
            background: rgba(255, 255, 255, 0.05);
            padding: 1.5rem;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            transition: all 0.3s ease;
        }

        .feature:hover {
            transform: translateY(-5px);
            background: rgba(255, 107, 107, 0.1);
            border-color: rgba(255, 107, 107, 0.3);
        }

        .feature i {
            font-size: 2rem;
            color: #ff6b6b;
            margin-bottom: 1rem;
        }

        .feature h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #ffffff;
        }

        .feature p {
            font-size: 0.9rem;
            color: #a0a0a0;
        }

        /* Booking Form */
        .booking-form {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 3rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-header h3 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: #a0a0a0;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #e0e0e0;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .form-group label .required {
            color: #ff6b6b;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #a0a0a0;
            font-size: 1rem;
            z-index: 2;
        }

        input, select, textarea {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            color: #ffffff;
            font-size: 1rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #ff6b6b;
            background: rgba(255, 255, 255, 0.12);
            box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.1);
        }

        input::placeholder, textarea::placeholder {
            color: #a0a0a0;
        }

        select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20width%3D%2214%22%20height%3D%2210%22%20viewBox%3D%220%200%2014%2010%22%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%3Cpath%20d%3D%22M1%200l6%206%206-6%22%20stroke%3D%22%23ff6b6b%22%20stroke-width%3D%222%22%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 14px 10px;
            cursor: pointer;
        }

        select option {
            background: #1a1a2e;
            color: #ffffff;
            padding: 0.5rem;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
            padding: 1rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .submit-btn {
            width: 100%;
            padding: 1.2rem 2rem;
            background: linear-gradient(135deg, #ff6b6b 0%, #ff8e8e 100%);
            border: none;
            border-radius: 12px;
            color: #ffffff;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px -5px rgba(255, 107, 107, 0.4);
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Loading Animation */
        .loading {
            display: none;
            text-align: center;
            margin-top: 1rem;
        }

        .spinner {
            width: 30px;
            height: 30px;
            border: 3px solid rgba(255, 107, 107, 0.3);
            border-top: 3px solid #ff6b6b;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Messages */
        .message {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            text-align: center;
        }

        .message.error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #f87171;
        }

        .message.success {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #4ade80;
        }

        .message.info {
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.3);
            color: #60a5fa;
        }

        /* Footer */
        .footer {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 2rem 0;
            margin-top: 4rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            text-align: center;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 1rem;
        }

        .footer-links a {
            color: #a0a0a0;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: #ff6b6b;
        }

        .footer p {
            color: #666;
            font-size: 0.9rem;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .features {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 1rem;
                padding: 0 1rem;
            }

            .nav-links {
                gap: 1rem;
            }

            .container {
                padding: 1rem;
            }

            .hero, .booking-form {
                padding: 2rem;
            }

            .hero h2 {
                font-size: 2rem;
            }

            .features {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .logo h1 {
                font-size: 1.6rem;
            }

            .hero, .booking-form {
                padding: 1.5rem;
            }

            .hero h2 {
                font-size: 1.6rem;
            }

            .hero p {
                font-size: 1rem;
            }

            input, select, textarea {
                padding: 0.8rem 0.8rem 0.8rem 2.5rem;
                font-size: 0.9rem;
            }

            .submit-btn {
                padding: 1rem 1.5rem;
                font-size: 1rem;
            }
        }

        /* Touch device optimizations */
        @media (hover: none) and (pointer: coarse) {
            input, select, textarea, .submit-btn {
                min-height: 44px;
            }
        }

        /* Accessibility improvements */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }

            .bg-animation::before {
                animation: none;
            }
        }
    </style>
</head>
<body>
    <div class="bg-animation"></div>

    <header class="header">
        <div class="header-content">
            <div class="logo">
                <i class="fas fa-fish"></i>
                <h1>AkiraOne</h1>
            </div>
            <nav class="nav-links">
                <a href="#prenota">Prenota</a>
                <a href="#menu">Menu</a>
                <a href="cancel_booking.php">Cancella Prenotazione</a>
                <a href="login.php">Admin</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <section class="hero">
            <i class="fas fa-torii-gate hero-icon"></i>
            <h2>Benvenuti da AkiraOne</h2>
            <p>Autentica esperienza culinaria giapponese nel cuore della città. Sushi fresco, sake pregiato e atmosfera tradizionale per un viaggio gastronomico indimenticabile.</p>
            
            <div class="features">
                <div class="feature">
                    <i class="fas fa-fish"></i>
                    <h3>Pesce Freschissimo</h3>
                    <p>Selezione quotidiana dal mercato del pesce</p>
                </div>
                <div class="feature">
                    <i class="fas fa-user-tie"></i>
                    <h3>Chef Akira</h3>
                    <p>15 anni di esperienza a Tokyo</p>
                </div>
                <div class="feature">
                    <i class="fas fa-wine-bottle"></i>
                    <h3>Sake Premium</h3>
                    <p>Selezione di sake e whisky giapponesi</p>
                </div>
                <div class="feature">
                    <i class="fas fa-utensils"></i>
                    <h3>Omakase</h3>
                    <p>Menu degustazione personalizzato</p>
                </div>
            </div>
        </section>

        <section class="booking-form" id="prenota">
            <div class="form-header">
                <h3>Prenota il tuo tavolo</h3>
                <p>Riserva la tua esperienza culinaria giapponese</p>
            </div>

            <form method="POST" action="prenota.php" id="bookingForm">
                <div class="form-group">
                    <label for="nome">Nome Completo <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input type="text" name="nome" id="nome" placeholder="Il tuo nome completo" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email" id="email" placeholder="la-tua-email@esempio.com">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Telefono <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-phone"></i>
                            <input type="tel" name="telefono" id="telefono" placeholder="+39 123 456 7890" required>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="numero_persone">Numero Persone <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-users"></i>
                            <select name="numero_persone" id="numero_persone" required>
                                <option value="">Seleziona</option>
                                <option value="1">1 persona</option>
                                <option value="2">2 persone</option>
                                <option value="3">3 persone</option>
                                <option value="4">4 persone</option>
                                <option value="5">5 persone</option>
                                <option value="6">6 persone</option>
                                <option value="7">7 persone</option>
                                <option value="8">8 persone</option>
                                <option value="9">9+ persone</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="menu">Menu Preferito</label>
                        <div class="input-wrapper">
                            <i class="fas fa-utensils"></i>
                            <select name="menu" id="menu">
                                <option value="">Sceglierò al ristorante</option>
                                <?php
                                include 'connessione.php';
                                $menu_query = $conn->query("SELECT nome FROM menu ORDER BY nome");
                                if ($menu_query && $menu_query->num_rows > 0) {
                                    while ($row = $menu_query->fetch_assoc()) {
                                        echo '<option value="' . htmlspecialchars($row['nome']) . '">' . htmlspecialchars($row['nome']) . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="data_prenotazione">Data <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-calendar"></i>
                            <input type="date" name="data_prenotazione" id="data_prenotazione" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="orario">Orario <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-clock"></i>
                            <select name="orario" id="orario" required>
                                <option value="">Prima seleziona la data</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tavolo_preferito">Preferenza Tavolo</label>
                    <div class="input-wrapper">
                        <i class="fas fa-chair"></i>
                        <select name="tavolo_preferito" id="tavolo_preferito">
                            <option value="interno">Sala interna</option>
                            <option value="esterno">Terrazza esterna</option>
                            <option value="sushi_bar">Bancone sushi</option>
                            <option value="privato">Sala privata</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="note_allergie">Note e Allergie</label>
                    <textarea name="note_allergie" id="note_allergie" placeholder="Eventuali allergie, intolleranze o richieste speciali..."></textarea>
                </div>

                <div class="form-group">
                    <label for="staff_id">Chef/Cameriere Preferito</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user-tie"></i>
                        <select name="staff_id" id="staff_id">
                            <option value="">Nessuna preferenza</option>
                            <?php
                            $staff = $conn->query("SELECT id, nome, cognome, ruolo FROM staff WHERE attivo = 1 ORDER BY nome");
                            if ($staff && $staff->num_rows > 0) {
                                while ($row = $staff->fetch_assoc()) {
                                    echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['nome'] . ' ' . $row['cognome'] . ' - ' . $row['ruolo']) . '</option>';
                                }
                            }
                            $conn->close();
                            ?>
                        </select>
                    </div>
                </div>

                <button type="submit" class="submit-btn" id="submitBtn">
                    <i class="fas fa-calendar-check"></i>
                    Prenota Tavolo
                </button>

                <div class="loading" id="loading">
                    <div class="spinner"></div>
                    <p>Elaborazione prenotazione...</p>
                </div>
            </form>
        </section>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-links">
                <a href="#prenota">Prenota</a>
                <a href="#menu">Menu</a>
                <a href="cancel_booking.php">Cancella Prenotazione</a>
                <a href="#contatti">Contatti</a>
            </div>
            <p>&copy; 2025 AkiraOne Sushi Restaurant. Tutti i diritti riservati.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('bookingForm');
            const dateInput = document.getElementById('data_prenotazione');
            const timeSelect = document.getElementById('orario');
            const submitBtn = document.getElementById('submitBtn');
            const loading = document.getElementById('loading');

            // Set minimum date to today
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            dateInput.min = tomorrow.toISOString().split('T')[0];

            // Set maximum date to 3 months from now
            const maxDate = new Date(today);
            maxDate.setMonth(maxDate.getMonth() + 3);
            dateInput.max = maxDate.toISOString().split('T')[0];

            // Load time slots when date changes
            dateInput.addEventListener('change', async () => {
                const selectedDate = dateInput.value;
                if (!selectedDate) return;

                timeSelect.innerHTML = '<option value="">Caricamento...</option>';
                timeSelect.disabled = true;

                try {
                    // Check if it's a working day
                    const workingDayResponse = await fetch(`check_working_day.php?date=${selectedDate}`);
                    const workingDayData = await workingDayResponse.json();

                    if (!workingDayData.isWorkingDay) {
                        timeSelect.innerHTML = '<option value="">Giorno di chiusura</option>';
                        return;
                    }

                    // Get available time slots
                    const timeSlotsResponse = await fetch('get_time_slots.php');
                    const timeSlots = await timeSlotsResponse.json();

                    timeSelect.innerHTML = '<option value="">Seleziona orario</option>';

                    for (const slot of timeSlots) {
                        const availabilityResponse = await fetch(`check_availability.php?date=${selectedDate}&time=${slot.orario}`);
                        const availability = await availabilityResponse.json();

                        const option = document.createElement('option');
                        option.value = slot.orario;
                        
                        const timeFormatted = slot.orario.substring(0, 5);
                        
                        if (availability.available) {
                            option.textContent = `${timeFormatted} - ${availability.message}`;
                            if (availability.remaining_spots !== 'unlimited' && availability.remaining_spots <= 3) {
                                option.textContent += ` (${availability.remaining_spots} posti)`;
                            }
                        } else {
                            option.textContent = `${timeFormatted} - ${availability.message}`;
                            option.disabled = true;
                        }

                        timeSelect.appendChild(option);
                    }

                    timeSelect.disabled = false;
                } catch (error) {
                    console.error('Error loading time slots:', error);
                    timeSelect.innerHTML = '<option value="">Errore nel caricamento</option>';
                }
            });

            // Form submission
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                
                // Validate required fields
                const nome = document.getElementById('nome').value.trim();
                const telefono = document.getElementById('telefono').value.trim();
                const numeroPersone = document.getElementById('numero_persone').value;
                const data = document.getElementById('data_prenotazione').value;
                const orario = document.getElementById('orario').value;

                if (!nome || !telefono || !numeroPersone || !data || !orario) {
                    alert('Per favore compila tutti i campi obbligatori.');
                    return;
                }

                // Show loading
                submitBtn.style.display = 'none';
                loading.style.display = 'block';

                // Submit form
                form.submit();
            });

            // Touch device optimizations
            if ('ontouchstart' in window) {
                document.body.classList.add('touch-device');
            }

            // Viewport height fix for mobile browsers
            function setViewportHeight() {
                const vh = window.innerHeight * 0.01;
                document.documentElement.style.setProperty('--vh', `${vh}px`);
            }

            setViewportHeight();
            window.addEventListener('resize', setViewportHeight);
            window.addEventListener('orientationchange', () => {
                setTimeout(setViewportHeight, 100);
            });
        });
    </script>
</body>
</html>