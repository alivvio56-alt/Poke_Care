<?php
session_start();

// Handle reset request
if (isset($_GET['reset'])) {
    unset($_SESSION['history']);
    // Redirect to avoid resubmission
    header("Location: history.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PokéCare - Riwayat Latihan</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #ffffff; /* Dominan putih bersih */
            background-image: linear-gradient(to right, #ff0000 5%, #ffffff 5%); /* Aksen merah tipis di kiri */
            color: #000;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }
        h1 {
            font-weight: 700;
            font-size: 2.5em;
            color: #ff0000;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.3);
            margin-bottom: 20px;
        }
        h2 {
            font-weight: 700;
            color: #333;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
        }
        .logo-section {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-template-rows: auto auto;
            gap: 20px;
            margin: 20px 0;
            max-width: 400px;
        }
        .logo-section img {
            width: 80px;
            height: 80px;
            object-fit: contain; /* Mencegah stretch */
            transition: transform 0.3s ease;
        }
        .logo-section img:nth-child(1) { /* Logo Pokémon - atas tengah */
            grid-column: 1 / span 3;
            grid-row: 1;
            width: 120px;
            height: 80px;
            margin: 0 auto;
        }
        .logo-section img:nth-child(2) { /* Pikachu - kiri bawah */
            grid-column: 1;
            grid-row: 2;
        }
        .logo-section img:nth-child(2):hover {
            transform: scale(1.2);
            filter: drop-shadow(0 0 10px #ffff00);
        }
        .logo-section img:nth-child(3) { /* Pokeball - tengah bawah */
            grid-column: 2;
            grid-row: 2;
        }
        .logo-section img:nth-child(3):hover {
            transform: rotate(360deg);
        }
        .logo-section img:nth-child(4) { /* Growlithe - kanan bawah */
            grid-column: 3;
            grid-row: 2;
        }
        .logo-section img:nth-child(4):hover {
            transform: scale(1.1) translateY(-10px);
        }
        .history-section {
            background-color: #fff;
            border: 2px solid #ff0000;
            border-radius: 15px;
            padding: 20px;
            max-width: 600px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            margin: 20px 0;
            width: 100%;
        }
        .history-item {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin: 10px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .history-summary {
            padding: 15px;
            cursor: pointer;
            font-weight: 500;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .history-summary:hover {
            background-color: #ffcc00;
        }
        .history-details {
            padding: 15px;
            border-top: 1px solid #ddd;
            display: none; /* Hidden by default */
        }
        .history-item.open .history-details {
            display: block;
        }
        .history-details p {
            margin: 5px 0;
            font-size: 16px;
        }
        .no-history {
            font-size: 18px;
            color: #666;
            margin: 20px 0;
        }
        .reset-button {
            background-color: #ff4444;
            color: #fff;
            border: 2px solid #cc0000;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 700;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            margin-top: 10px;
        }
        .reset-button:hover {
            background-color: #cc0000;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.3);
        }
        .nav-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }
        .nav-button {
            background-color: #ffcc00;
            color: #000;
            border: 2px solid #ff0000;
            padding: 15px 30px;
            font-size: 18px;
            font-weight: 700;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .nav-button:hover {
            background-color: #ffaa00;
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.3);
        }
        @media (max-width: 600px) {
            .logo-section {
                grid-template-columns: 1fr;
                grid-template-rows: auto auto auto auto;
            }
            .logo-section img:nth-child(1) {
                grid-column: 1;
                grid-row: 1;
            }
            .logo-section img:nth-child(2) {
                grid-column: 1;
                grid-row: 2;
            }
            .logo-section img:nth-child(3) {
                grid-column: 1;
                grid-row: 3;
            }
            .logo-section img:nth-child(4) {
                grid-column: 1;
                grid-row: 4;
            }
            .nav-buttons {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
    <script>
        function toggleHistory(item) {
            item.classList.toggle('open');
        }
        function confirmReset() {
            return confirm("Apakah Anda yakin ingin mereset semua riwayat latihan? Tindakan ini tidak dapat dibatalkan.");
        }
    </script>
</head>
<body>
    <h1>PokéCare - Riwayat Latihan</h1>
    <div class="logo-section">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/International_Pok%C3%A9mon_logo.svg/256px-International_Pok%C3%A9mon_logo.svg.png" alt="Pokémon Logo"> <!-- Logo Pokémon atas -->
        <img src="https://assets.pokemon.com/assets/cms2/img/pokedex/full/025.png" alt="Pikachu Icon"> <!-- Pikachu kiri bawah -->
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Pok%C3%A9_Ball_icon.svg/512px-Pok%C3%A9_Ball_icon.svg.png" alt="Pokeball"> <!-- Pokeball tengah bawah -->
        <img src="https://assets.pokemon.com/assets/cms2/img/pokedex/full/058.png" alt="Growlithe Icon"> <!-- Growlithe kanan bawah -->
    </div>
    <div class="history-section">
        <h2>Riwayat Latihan</h2>
        <?php if (isset($_SESSION['history']) && count($_SESSION['history']) > 0): ?>
            <a href="history.php?reset=1" class="reset-button" onclick="return confirmReset();">Reset Riwayat Latihan</a>
            <?php foreach ($_SESSION['history'] as $index => $session): ?>
                <div class="history-item" onclick="toggleHistory(this)">
                    <div class="history-summary">
                        <span><strong>Sesi <?php echo $index + 1; ?>:</strong> <?php echo $session['type']; ?> - Intensitas <?php echo $session['intensity']; ?></span>
                        <span>▼</span>
                    </div>
                    <div class="history-details">
                        <p><strong>Jenis:</strong> <?php echo $session['type']; ?></p>
                        <p><strong>Intensitas:</strong> <?php echo $session['intensity']; ?></p>
                        <p><strong>Level:</strong> <?php echo $session['oldLevel']; ?> → <?php echo $session['newLevel']; ?></p>
                        <p><strong>HP:</strong> <?php echo $session['oldHp']; ?> → <?php echo $session['newHp']; ?></p>
                        <p><strong>Waktu:</strong> <?php echo $session['time']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-history">Belum ada riwayat latihan.</p>
        <?php endif; ?>
    </div>
    <div class="nav-buttons">
        <a href="index.php" class="nav-button">Kembali ke Beranda</a>
    </div>
</body>
</html>
