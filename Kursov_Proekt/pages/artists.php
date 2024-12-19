<?php
// artists.php

require_once('C:\xampp\htdocs\Desi-122211\Kursov_Proekt\db.php');

// Връзка с базата данни

// Получаваме стойността от параметъра за търсене
$search = $_GET['search'] ?? ''; 

// Създаване на масив за художниците
$artists = [];

// SQL заявка за извличане на художниците, които съвпадат с търсенето
$query = "SELECT * FROM artists WHERE name LIKE :search";
$stmt = $pdo->prepare($query);
$stmt->execute([':search' => "%$search%"]);

// Зареждаме резултатите в масива
while ($row = $stmt->fetch()) {
    $artists[] = $row;
}

// Записваме търсенето в cookie (ако е налично)
if ($search) {
    setcookie('last_search', $search, time() + 3600);  
}
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Художници</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Стилизация на картата на художника */
        .artist-card {
            margin: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
            display: grid;
            grid-template-columns: 40% 60%;
            grid-template-rows: 1fr auto;
            gap: 0;
            height: 100%;
        }

        .artist-card:hover {
            transform: translateY(-10px);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        }

        .artist-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .artist-card .card-body {
            background-color: #f9f9f9;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            grid-column: 2 / 3;
        }

        .artist-card .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 0;
        }

        .artist-card .card-text {
            font-size: 1rem;
            color: #7f8c8d;
            margin-top: 5px;
            flex-grow: 1;
        }

        .artist-card .card-footer {
            background-color: #2c3e50;
            padding: 10px;
            text-align: center;
        }

        .artist-card .card-footer .btn-primary {
            background-color: #f39c12;
            color: #2c3e50;
        }

        .artist-card .card-footer .btn-primary:hover {
            background-color: #f39c12;
            color: white;
        }

        .artist-container {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
        }

        .search-container {
            margin-bottom: 30px;
            text-align: center;
        }

        .search-container input {
            width: 300px;
            margin-right: 10px;
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

        .no-results {
            font-size: 24px;
            color: red;
            text-align: center;
            font-weight: bold;
        }

        .mt-3 {
            display: flex;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <!-- Форма за търсене на художници -->
        <div class="search-container">
            <form id="search-form" method="GET" class="d-flex justify-content-center mb-4">
                <input type="text" class="form-control" placeholder="Търсене на художник" name="search" value="<?php echo htmlspecialchars($search); ?>" id="search-input">
                <button class="search-btn" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <!-- Показване на последното търсене, ако има такова -->
        <div class="row mb-4">
            <?php
            if (isset($_COOKIE['last_search'])) {
                echo '<h5>Последно търсене: ' . $_COOKIE['last_search'] . '</h5>';
            }
            ?>
        </div>

        <!-- Списък с художниците -->
        <div class="artist-container" id="artists-container">
            <?php
                if (count($artists) === 0) {
                    echo '<div class="no-results">Няма намерени художници</div>';
                } else {
                    foreach ($artists as $artist) {
                        echo '
                            <div class="col-md-12 mb-4">
                                <div class="card artist-card">
                                    <img src="' . htmlspecialchars($artist['image']) . '" class="card-img-top" alt="Artist Image">
                                    <div class="card-body">
                                        <h5 class="card-title">' . htmlspecialchars($artist['name']) . '</h5>
                                        <p class="card-text">' . htmlspecialchars($artist['bio']) . '</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="pages/artist_profile.php?id=' . $artist['id'] . '" class="btn btn-primary">Вижте произведения</a>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                }
            ?>
        </div>
    </div>

    <!-- Включване на jQuery за обработка на AJAX заявките -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Обработване на изпращането на формата
            $('#search-form').on('submit', function(e) {
                e.preventDefault(); 

                var searchQuery = $('#search-input').val(); 

                // Изпращаме заявката чрез AJAX
                $.ajax({
                    url: 'artists.php', 
                    type: 'GET',
                    data: { search: searchQuery }, 
                    success: function(response) {
                        
                        $('#artists-container').html(response);
                    },
                    error: function() {
                        alert("Грешка при извършване на търсенето.");
                    }
                });
            });
        });
    </script>
</body>
</html>
