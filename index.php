<?php
session_start();
require_once 'classes/Growlithe.php';

$pokemon = new Growlithe();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PokéCare - Beranda</title>
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
        .pokemon-info {
            background-color: #fff;
            border: 2px solid #ff0000;
            border-radius: 15px;
            padding: 20px;
            max-width: 600px; /* Sedikit diperbesar untuk akomodasi gambar */
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            margin: 20px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px; /* Jarak antara teks dan gambar */
        }
        .info-text {
            flex: 1;
        }
        .pokemon-info img {
            width: 150px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            flex-shrink: 0; /* Mencegah gambar menyusut */
        }
        .pokemon-info p {
            font-size: 18px;
            margin: 10px 0;
            font-weight: 500;
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
            .pokemon-info {
                flex-direction: column; /* Stack vertikal di mobile */
                text-align: center;
            }
            .pokemon-info img {
                width: 100px; /* Lebih kecil di mobile */
                margin-top: 15px;
            }
        }
    </style>
</head>
<body>
    <h1>PokéCare - Research & Training Center</h1>
    <div class="logo-section">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/International_Pok%C3%A9mon_logo.svg/256px-International_Pok%C3%A9mon_logo.svg.png" alt="Pokémon Logo"> <!-- Logo Pokémon atas -->
        <img src="https://assets.pokemon.com/assets/cms2/img/pokedex/full/025.png" alt="Pikachu Icon"> <!-- Pikachu kiri bawah -->
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Pok%C3%A9_Ball_icon.svg/512px-Pok%C3%A9_Ball_icon.svg.png" alt="Pokeball"> <!-- Pokeball tengah bawah -->
        <img src="https://assets.pokemon.com/assets/cms2/img/pokedex/full/058.png" alt="Growlithe Icon"> <!-- Growlithe kanan bawah -->
    </div>
    <div class="pokemon-info">
        <div class="info-text">
            <h2>Informasi Dasar Pokémon</h2>
            <p>Nama: <?php echo $pokemon->getName(); ?></p>
            <p>Tipe: <?php echo $pokemon->getType(); ?></p>
            <p>Level Awal: <?php echo $pokemon->getLevel(); ?></p>
            <p>HP Awal: <?php echo $pokemon->getHp(); ?></p>
            <p>Jurus Spesial: <?php echo $pokemon->specialMove(); ?></p>
        </div>
        <img src="https://asia.pokemon-card.com/id/card-img/id00008469.png" alt="Growlithe Card">
    </div>
    <div class="nav-buttons">
        <a href="train.php" class="nav-button">Mulai Latihan</a>
        <a href="history.php" class="nav-button">Riwayat Latihan</a>
    </div>
</body>
</html>
