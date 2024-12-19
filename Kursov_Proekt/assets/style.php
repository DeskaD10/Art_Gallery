<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Галерия</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="path/to/bootstrap.css"> <!-- За стиловете на бутоните -->
</head>
<body>
    <!-- Форма за търсене на картини -->
    <div class="row">
        <form class="mb-4" method="GET">
            <div class="input-group">
                <input type="hidden" name="page" value="gallery">
                <input type="text" class="form-control" placeholder="Търсене на картини" name="search" value="<?php echo $search ?>">
                <button class="btn btn-primary" type="submit">Търсене</button>
            </div>
        </form>
    </div>

    <!-- Галерия с картини -->
    <div class="d-flex flex-wrap justify-content-between">
        <?php
            if (count($paintings) === 0) {
                echo '<h1>Няма намерени картини</h1>';
            } else {
                foreach ($paintings as $painting) {
                    echo '
                        <div class="card mb-4" style="width: 18rem;">
                            <img src="uploads/' . htmlspecialchars($painting['image']) . '" class="card-img-top" alt="Painting Image">
                            <div class="card-body">
                                <h5 class="card-title">' . htmlspecialchars($painting['title']) . '</h5>
                                <p class="card-text">Автор: ' . htmlspecialchars($painting['artist']) . '</p>
                                <p class="card-text">Цена: ' . htmlspecialchars($painting['price']) . ' лв.</p>
                            </div>
                            <div class="card-footer text-center">
                                <button class="btn btn-primary add-to-cart" data-id="' . $painting['id'] . '">Добави в количката</button>
                            </div>
                        </div>
                    ';
                }
            }
        ?>
    </div>

</body>
</html>