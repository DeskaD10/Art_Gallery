<?php
// artist_profile.php

require_once('C:\xampp\htdocs\Desi-122211\Kursov_Proekt\db.php');

// Вземаме ID на художника от URL параметъра
$artistId = $_GET['id'] ?? null;

if (!$artistId) {
    echo 'Няма избран художник.';
    exit;
}

// Подготовка на SQL заявка за извличане на информация за художника
$query = "SELECT * FROM artists WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute([':id' => $artistId]);

// Извличане на данните за художника
$artist = $stmt->fetch();

if (!$artist) {
    echo 'Художникът не е намерен.';
    exit;
}

// Новата заявка за картините в таблицата paintings (заменяме стария код с тази заявка)
$queryPaintings = "SELECT * FROM paintings WHERE artist_id = :artist_id";
$stmtPaintings = $pdo->prepare($queryPaintings);
$stmtPaintings->execute([':artist_id' => $artistId]);

// Зареждаме картините в масив
$paintings = [];
while ($row = $stmtPaintings->fetch()) {
    $paintings[] = $row;
}
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Произведения на <?php echo htmlspecialchars($artist['name']); ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #2c3e50;
        }

        .navbar a {
            color: white;
            font-weight: bold;
            padding: 15px 20px;
        }

        .navbar a:hover {
            background-color: #2c3e50;
        }

        .artwork-card {
            margin: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .artwork-card:hover {
            transform: translateY(-10px);
        }

        .artwork-card img {
            height: 250px;
            width: 100%;
            object-fit: cover;
        }

        .artwork-card .card-body {
            padding: 20px;
            background-color: #fff;
            text-align: center;
        }

        .artwork-card .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #2c3e50;
        }

        .artwork-card .card-text {
            font-size: 1rem;
            color: #7f8c8d;
            margin: 10px 0;
        }

        .artwork-card .price {
            font-size: 1.2rem;
            color: #f39c12;
            font-weight: bold;
        }

        .artist-bio {
            font-size: 1.2rem;
            color: #333;
            line-height: 1.6;
            margin-bottom: 30px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .artist-container {
            display: flex;
          
            justify-content: space-between;
            gap: 20px;
            padding-top: 30px;
        }

        .container {
            padding-top: 30px;
        }

        /* .card-footer {
            background-color: #3498db;
            padding: 10px;
            text-align: center;
        }

        .card-footer .btn-primary {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        .card-footer .btn-primary:hover {
            background-color: #1c5980;
            border-color: #1c5980;
        } */

        h1, h2 {
            text-align: center;
            font-size: 2.5rem;
            color: #2c3e50;
        }

        .artist-image {
            max-width: 200px;
            border-radius: 10px;
            margin: 20px;
        }

        .artist-info {
            display: flex;
            align-items: flex-start;
            gap: 30px;
            margin-bottom: 30px;
        }

        .artist-bio-container {
            flex: 1;
        }

        .artist-container .col-md-4 {
            width: 32%;
            margin-bottom: 30px;
        }

    </style>
</head>
<body>

    <div class="container mt-4">
        <!-- Информация за художника -->
        <h1><?php echo htmlspecialchars($artist['name']); ?></h1>

        <div class="artist-info">
            <!-- Снимка на художника -->
            <?php if (!empty($artist['image'])): ?>
                <img src="<?php echo htmlspecialchars($artist['image']); ?>" alt="<?php echo htmlspecialchars($artist['name']); ?>" class="artist-image">
            <?php endif; ?>

            <!-- Биография на художника -->
            <div class="artist-bio-container">
                <div class="artist-bio">
                    <p><strong>Биография:</strong></p>
                    <p><?php echo nl2br(htmlspecialchars($artist['bio'])); ?></p>
                </div>
            </div>
        </div>

        <!-- Произведения на художника -->
        <h2>Произведения на <?php echo htmlspecialchars($artist['name']); ?></h2>
        <div class="artist-container">
            <?php
                if (count($paintings) === 0) {
                    echo '<h3>Няма произведения за този художник.</h3>';
                } else {
                    // Показваме картините
                    foreach ($paintings as $painting) {
                        echo '
                            <div class="col-md-4">
                                <div class="card artwork-card">
                                    <img src="' . htmlspecialchars($painting['image']) . '" class="card-img-top" alt="Painting Image">
                                    <div class="card-body">
                                        <h5 class="card-title">' . htmlspecialchars($painting['title']) . '</h5>
                                        <p class="card-text">' . (isset($painting['description']) ? htmlspecialchars($painting['description']) : 'Няма описание') . '</p>
                                        <p class="price">' . htmlspecialchars($painting['price']) . ' лв</p>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
