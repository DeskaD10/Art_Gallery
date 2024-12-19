<?php

require_once('functions.php');
require_once('db.php');

$page = $_GET['page'] ?? 'home';
$search = $_GET['search'] ?? '';


if (mb_strlen($search) > 0) {
    setcookie('last_search', $search, time() + 3600, '/', 'localhost', false, false);
}

$flash = [];
if (isset($_SESSION['flash'])) {
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
}

// $admin_pages = ['add_painting', 'edit_painting'];

// if (in_array($page, $admin_pages) && !is_admin()) {
//     $_SESSION['flash']['message']['type'] = 'warning';
//     $_SESSION['flash']['message']['text'] = "Нямате достъп до тази страница!";

//     header('Location: ./index.php?page=home');
//     exit;
// }
?>
 <?php
// Проверка за flash съобщения
//if (isset($_SESSION['flash']['message'])) {
//     $message = $_SESSION['flash']['message'];
//     echo "<script>
//         Swal.fire({
//             icon: '{$message['type']}',
//             title: 'Съобщение',
//             text: '{$message['text']}',
//             timer: 3000,
//             showConfirmButton: false
//         });
//     </script>";
//     unset($_SESSION['flash']['message']); // Изтриване след показване
// }
?>
<?php
// if (isset($_SESSION['flash']['message'])) {
//     $message = $_SESSION['flash']['message'];
//     echo "<div class='alert alert-{$message['type']}'>
//         {$message['text']}
//     </div>";
//     unset($_SESSION['flash']['message']); // Изтриване след показване
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мистичен Свят на Изкуствата</title>
    <!-- Bootstrap 5.3 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css" rel="stylesheet">
<!-- Font Awesome CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f7f7f7;
            font-family: 'Arial', sans-serif;
        }

        header {
            background-color: #2c3e50;
            position: relative;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            font-size: 1.1rem;
        }

        .navbar-nav .nav-link.active {
            color: #f39c12 !important;
        }

        footer {
            background-color:#f39c12;
            color: #2c3e50;
            padding: 10px 0;
        }

        .footer-logo {
            max-width: 200px;
        }

        .footer-contact {
            margin-top: 5px;
        }

        .footer-contact p {
            margin: 5px 0;
            font-weight:bold;
        }

        .btn-outline-light {
            border-color: #2c3e50;
            color: #f39c12;
        }

        .btn-outline-light:hover {
            background-color: #f39c12;
            color: white;
        }

        .container {
            max-width: 1200px;
        }
        .hero-section {
    position: relative;
    background-image: url('https://culturizm.com/wp-content/uploads/2024/01/contemporary_art_styles.png.webp'); 
    background-size: cover;
    background-position: center;
    height: 100vh; 
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7); 
}

.hero-content {
    position: relative;
    text-align: center;
    z-index: 1;
}

.hero-title {
    font-size: 3rem;
    font-weight: bold;
    margin-bottom: 20px;
    letter-spacing: 1px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6); 
    text-align: center;
}

.hero-description {
    font-size: 1.2rem;
    margin-bottom: 30px;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
    font-weight: 300;
}

.btn-hero {
    background-color: #f39c12;
    font-weight: bold;
    color: #2c3e50;
    font-size: 1.2rem;
    padding: 15px 30px;
    border-radius: 50px;
    text-decoration: none;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.btn-hero:hover {
    background-color: #2c3e50;
    color: #f39c12;
    transform: translateY(-5px);
}

.btn-hero:active {
    transform: translateY(2px);
}

        .painting-card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            margin: 10px;
            background-color: #fff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .painting-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .painting-card .card-body {
            padding: 20px;
        }

        .painting-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .painting-card .btn {
            background-color: #f39c12;
            color: white;
        }

        .painting-card .btn:hover {
            background-color: #e67e22;
        }

        .login-register-btns {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
        }

        .login-register-btns .btn {
            background-color: #2c3e50;
            color: #e67e22;
            border-radius: 30px;
            border: 1px solid white;
            padding: 10px 20px;
            margin-left: 10px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .login-register-btns .btn:hover {
            background-color: #f39c12;
            color: #2c3e50;
        }

        .navbar-nav {
            flex-grow: 1;
        }

        footer .social-icons a {
            color: #2c3e50;
            margin-right: 15px;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        footer .social-icons a:hover {
            color: white;
        }
        .login-register-btns {
    margin-right: 15px; 
   
}
.btn-primary{
    background-color: #2c3e50;
            color: #e67e22;
            border-radius: 30px;
            padding: 10px 20px;
            margin-left: 10px;
            font-size: 1rem;
            align-items: center;
            transition: background-color 0.3s ease;
}
.btn-primary:hover {
            background-color: #f39c12;
            color: #2c3e50;
        }

    </style>
</head>
<body>
<script>
    $(function() {
        // добавяне в любими (харесване)
        $(document).on('click', '.like-btn', function() {
            let btn = $(this);
            let paintingId = btn.data('id'); 
            $.ajax({
                url: './ajax/add_favorite.php', 
                method: 'POST',
                data: { painting_id: paintingId },
                success: function(response) {
                    let res = JSON.parse(response);
                    if (res.success) {
                        alert('Картината беше добавена успешно в любими.');
                        let removeBtn = $('<button type="button" class="btn btn-sm btn-danger remove-from-favorites" data-id="' + paintingId + '">Отхаресай</button>');
                        btn.replaceWith(removeBtn);
                    } else {
                        alert('Възникна грешка: ' + res.error);
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });

        // премахване от любими (отхаресване)
        $(document).on('click', '.remove-from-favorites', function() {
            let btn = $(this);
            let paintingId = btn.data('id'); 
            $.ajax({
                url: './ajax/remove_from_favorite.php', 
                method: 'POST',
                data: { painting_id: paintingId },
                success: function(response) {
                    let res = JSON.parse(response);
                    if (res.success) {
                        alert('Картината беше премахната успешно от любими.');

                        let addBtn = $('<button type="button" class="btn btn-link like-btn" data-id="' + paintingId + '"><i class="fas fa-heart" style="color: white;"></i></button>');
                        btn.replaceWith(addBtn);
                    } else {
                        alert('Възникна грешка: ' + res.error);
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
  

    // $(document).ready(function() {
    // $('form').submit(function(event) {
    //     event.preventDefault(); // Прекратяваме стандартното изпращане на формата

    //     var formData = $(this).serialize(); // Серилизираме данните от формата

    //     $.ajax({
    //         url: './ajax/add_contact.php', // Уверете се, че пътят е правилен
    //         type: 'POST',
    //         data: formData,
    //         success: function(response) {
    //             var result = JSON.parse(response);
    //             if (result.success) {
    //                 alert(result.message); // Покажете съобщението от PHP скрипта
    //             } else {
    //                 alert(result.message); // Покажете грешката
    //             }
    //         },
    //         error: function(xhr, status, error) {
    //             alert('Грешка при изпращане на данните.');
    //         }
    //     });
    // });
    //   });
});

</script>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
            <a class="navbar-brand" href="#">
    <img src="gallery.png" alt="Мистичен Свят на Изкуствата" style="max-height: 50px;">
</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link <?php echo($page == 'home' ? 'active' : '') ?>" href="?page=home">Начало</a></li>
                        <li class="nav-item"><a class="nav-link <?php echo($page == 'gallery' ? 'active' : '') ?>" href="?page=gallery">Галерия</a></li>
                        <li class="nav-item"><a class="nav-link <?php echo($page == 'artists' ? 'active' : '') ?>" href="?page=artists">Художници</a></li>
                        <li class="nav-item"><a class="nav-link <?php echo($page == 'contact' ? 'active' : '') ?>" href="?page=contact">Контакти</a></li>
                    </ul>

                   <!-- Fixed Login and Register Buttons -->
<div class="login-register-btns d-flex align-items-center justify-content-end">
    <?php
        if (isset($_SESSION['user_name'])) {
            echo '<span class="text-light me-3 fs-5">Добре дошли, ' . htmlspecialchars($_SESSION['user_name']) . '</span>';
            echo '
                <form method="POST" action="./handlers/handle_logout.php" class="d-inline-block ms-2">
                    <button type="submit" class="btn btn-danger px-4 py-2">Изход</button>
                </form>
            ';
        } else {
            echo '<a href="?page=login" class="btn btn-outline-light me-2 px-4 py-2">Вход</a>';
            echo '<a href="?page=register" class="btn btn-light px-4 py-2">Регистрация</a>';
        }
    ?>

</div>

                    
                </div>
            </div>
        </nav>
    </header>

    <main class="container py-4">

    <?php
        if (isset($flash['message'])) {
            $icon_values = ['success' => 'success', 'danger' => 'error', 'warning' => 'warning'];

            echo '
                <script>
                    Swal.fire({
                        title: "' . $flash['message']['text'] . '",
                        icon: "' . $icon_values[$flash['message']['type']] . '",
                        toast: true,
                        position: "top",
                        showConfirmButton: false,
                        timer: 6000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        },
                        showCloseButton: true,
                    });
                </script>
            ';
        }

        if (file_exists('./pages/' . $page . '.php')) {
            require_once('./pages/' . $page . '.php');
        } else {
            require_once('./pages/not_found.php');
        }
    ?>
</main>


    <!-- New Footer with Contacts -->
    <footer>
        <div class="container text-center">
            <img src="gallery.png" alt="Gallery Logo" class="footer-logo">
            <div class="footer-contact">
                <p>Телефон: +359 123 456 789</p>
                <p>Имейл: info@artgallery.com</p>
                <div class="social-icons">
                <a href="https://www.facebook.com" target="_blank" class="fab fa-facebook"></a>
                <a href="https://www.instagram.com" target="_blank" class="fab fa-instagram"></a>
                <a href="https://www.twitter.com" target="_blank" class="fab fa-twitter"></a>

                </div>
            </div>
        </div>
    </footer>

</body>
</html>
