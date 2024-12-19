<?php
require_once('C:\xampp\htdocs\Desi-122211\Kursov_Proekt\db.php');
$search = $_GET['search'] ?? '';

// Масив за картините
$paintings = [];

// Ако има търсене, извършваме заявка към базата данни
if ($search) {
    $query = "SELECT * FROM paintings WHERE name LIKE :search";

    $stmt = $pdo->prepare($query);
    $stmt->execute([':search' => "%$search%"]);

    while ($row = $stmt->fetch()) {
        $fav_query = "SELECT id FROM favorite_paintings WHERE user_id = :user_id AND painting_id = :painting_id";
        $fav_stmt = $pdo->prepare($fav_query);
        $fav_params = [
            ':user_id' => $_SESSION['user_id'] ?? 0,
            ':painting_id' => $row['id']
        ];
        $fav_stmt->execute($fav_params);
        $row['is_favorite'] = $fav_stmt->fetch() ? '1' : '0';

        $paintings[] = $row;
    }
}

// Свързване с базата данни (запитване за карти)
$query = "SELECT paintings.*, artists.name AS artist_name 
          FROM paintings
          JOIN artists ON paintings.artist_id = artists.id
          WHERE paintings.title LIKE :search";

// Подготовка и изпълнение на SQL заявката с параметър за търсене
$stmt = $pdo->prepare($query);
$stmt->execute([':search' => "%$search%"]);


while ($row = $stmt->fetch()) {
    $row['is_favorite'] = in_array($row['id'], $_SESSION['favorites'] ?? []) ? '1' : '0';
    $paintings[] = $row;
}
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Галерия</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
       
        .painting-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .painting-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .painting-img {
            height: 200px;
            object-fit: cover;
        }

        .painting-info {
            font-size: 14px;
            color: #555;
        }

        .painting-title {
            font-size: 18px;
            font-weight: bold;
        }

     
        .search-btn {
            border-radius: 50%;
            background-color: #2c3e50; 
            color: #f39c12; 
            font-size: 20px;
            width: 45px; 
            height: 40px; 
            display: flex;
            justify-content: center;
            align-items: center;
            border: none;
            transition: background-color 0.3s, color 0.3s;
        }

       
        .search-btn:hover {
            background-color: #f39c12; 
            color: #2c3e50; 
            cursor: pointer; 
        }

       
        .search-input {
            flex-grow: 1;
            margin-right: 10px;
        }

        .no-results {
            font-size: 24px;
            color: red;
            text-align: center;
            font-weight: bold;
        }
        .mt-3{
            display: flex;
        }
      
        
    </style>
</head>
<body> 
<div class ="container my-4">
    <!-- Форма за търсене на картини -->
    <div class="row mb-4">
        <div class="col-md-6 offset-md-3">
        <form id="search-form" class="d-flex">
    <input type="text" name="search" class="form-control" id="search-input" placeholder="Търсене на картини" value="<?php echo htmlspecialchars($search); ?>">
    <button type="submit" class="search-btn">
        <i class="fas fa-search"></i>
    </button>
</form>
        </div>
    </div>
</div>
    <!-- Показване на последното търсене, ако има такова -->
    <div class="row mb-4">
        <?php
        if (isset($_COOKIE['last_search'])) {
            echo '<h5>Последно търсене: ' . $_COOKIE['last_search'] . '</h5>';
        }
        ?>
    </div>

    <!-- Галерия с картини -->
  
    <!-- Тук ще се обновяват картините при всяко търсене -->
    <div id="gallery-container" class="row row-cols-1 row-cols-md-3 g-4"></div>
    <?php if (empty($paintings)): ?>
        <div class="col-12">
            <div class="no-results">
                Няма намерени картини с такова заглавие
            </div>
        </div> 
    <?php else: ?>
        <?php foreach ($paintings as $painting): ?>
            <div class="col">
                <div class="card painting-card shadow-sm">
                    <img src="<?php echo htmlspecialchars($painting['image']); ?>" class="card-img-top painting-img" alt="Painting">
                    <div class="card-body">
                        <h5 class="card-title painting-title"><?php echo htmlspecialchars($painting['title']); ?></h5>
                        <p class="card-text">Автор: <?php echo htmlspecialchars($painting['artist_name']); ?></p>
                        <p class="card-text painting-info">Цена: <?php echo htmlspecialchars($painting['price']); ?> лв.</p>
                        
                           <!-- Любими бутон -->
                           <?php if (isset($_SESSION['user_id'])): ?>
                                <?php if ($painting['is_favorite'] == '1'): ?>
                                <?php else: ?>
                                    <div class="mt-3">
                                <button class="btn btn-link like-btn" data-id="<?php echo $painting['id']; ?>" id="like-btn-<?php echo $painting['id']; ?>">
                                    <i class="fas fa-heart" style="color: <?php echo in_array($painting['id'], $_SESSION['favorites'] ?? []) ? 'red' : 'white'; ?>;"></i>
                                </button>
                                       <!-- Бутон за премахване от любими (Отхаресай) -->
                                <button class="btn btn-danger remove-from-favorites" data-id="<?php echo $painting['id']; ?>">Отхаресай</button>
                                <?php endif; ?>
                            <?php endif; ?>
                       
                            
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
   
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</body>
</html>
