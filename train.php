<?php
session_start();
require_once 'classes/Growlithe.php';

$pokemon = new Growlithe();
$result = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['type'];
    $intensity = (int)$_POST['intensity'];
    $result = $pokemon->train($type, $intensity);

    // Simpan riwayat ke session
    if (!isset($_SESSION['history'])) {
        $_SESSION['history'] = [];
    }
    $_SESSION['history'][] = [
        'type' => $type,
        'intensity' => $intensity,
        'oldLevel' => $result['oldLevel'],
        'newLevel' => $result['newLevel'],
        'oldHp' => $result['oldHp'],
        'newHp' => $result['newHp'],
        'time' => date('Y-m-d H:i:s')
    ];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PokéCare - Latihan</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #ffffff; /* Dominan putih */
            background-image: linear-gradient(to bottom right, rgba(255,0,0,0.1) 0%, rgba(255,255,255,0) 50%); /* Aksen gradasi tipis merah */
            color: #333;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            position: relative;
        }
        .header {
            position: absolute;
            top: 20px;
            left: 20px;
            display: flex;
            align-items: center;
            font-size: 2em; /* Diperbesar dari 1.5em */
            font-weight: 700;
            color: #ff0000;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
        }
        .header img {
            width: 80px; /* Diperbesar dari 50px */
            height: 60px; /* Diperbesar dari 40px */
            margin-right: 10px;
            object-fit: contain;
        }
        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            max-width: 1200px;
            margin: 80px auto 0; /* Margin atas untuk header */
            gap: 40px;
        }
        .left-column {
            flex: 1;
            max-width: 500px;
        }
        .right-column {
            flex: 1;
            max-width: 500px;
        }
        h1 {
            font-weight: 700;
            font-size: 2em;
            color: #333;
            margin-bottom: 20px;
        }
        form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            border: 2px solid #ddd;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        form:hover {
            border-color: #ff0000;
            box-shadow: 0 4px 10px rgba(255,0,0,0.2);
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: 500;
        }
        select, input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background-color: #ffcc00;
            color: #000;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        button:hover {
            background-color: #ffaa00;
            transform: scale(1.05);
        }
        .result {
            background-color: #fff;
            border: 2px solid #ff0000;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            animation: slideIn 0.5s ease;
        }
        @keyframes slideIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .gif-container {
            text-align: center;
            margin-top: 20px;
        }
        .gif-container img {
            width: 150px;
            height: 150px;
            border-radius: 10px;
            animation: fadeIn 1s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .nav-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }
        .nav-button {
            background-color: #e0e0e0;
            color: #333;
            border: 1px solid #ccc;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .nav-button:hover {
            background-color: #ccc;
        }
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
                margin-top: 100px;
            }
            .left-column, .right-column {
                max-width: 100%;
            }
            .header {
                font-size: 1.5em; /* Diperkecil untuk mobile */
                left: 10px;
            }
            .header img {
                width: 60px; /* Diperkecil untuk mobile */
                height: 45px;
            }
            .nav-buttons {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/International_Pok%C3%A9mon_logo.svg/256px-International_Pok%C3%A9mon_logo.svg.png" alt="Pokémon Logo">
        PokéCare - Latihan
    </div>
    <div class="container">
        <div class="left-column">
            <h1>Latihan Pokémon</h1>
            <form method="POST">
                <label>Jenis Latihan:</label>
                <select name="type">
                    <option value="Attack">Attack</option>
                    <option value="Defense">Defense</option>
                    <option value="Speed">Speed</option>
                </select><br>
                <label>Intensitas (1-10):</label>
                <input type="number" name="intensity" min="1" max="10" required><br>
                <button type="submit">Latih</button>
            </form>
        </div>
        <div class="right-column">
            <?php if ($result): ?>
                <div class="result">
                    <h2>Hasil Latihan</h2>
                    <p>Level: <?php echo $result['oldLevel']; ?> → <?php echo $result['newLevel']; ?></p>
                    <p>HP: <?php echo $result['oldHp']; ?> → <?php echo $result['newHp']; ?></p>
                    <p>Jurus Spesial: <?php echo $pokemon->specialMove(); ?></p>
                    <div class="gif-container">
                        <img src="https://media.tenor.com/1om_-86O6x4AAAAM/growlithe-pokemon.gif" alt="Growlithe GIF">
                    </div>
                </div>
            <?php else: ?>
                <div class="result" style="opacity: 0.5;">
                    <h2>Hasil Latihan</h2>
                    <p>Belum ada hasil. Lakukan latihan terlebih dahulu.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="nav-buttons">
        <a href="index.php" class="nav-button">Kembali ke Beranda</a>
        <a href="history.php" class="nav-button">Riwayat Latihan</a>
    </div>
</body>
</html>
