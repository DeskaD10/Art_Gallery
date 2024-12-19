<?php

?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакти</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f7f7f7;
            font-family: 'Arial', sans-serif;
        }

        .contact-container {
            max-width: 700px;
            margin: 50px auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 30px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #ddd;
            font-size: 1.1rem;
        }

        .form-group label {
            font-weight: bold;
            color: #2c3e50;
        }

        .form-control:focus {
            border-color: #f39c12;
            box-shadow: 0 0 5px rgba(243, 156, 18, 0.6);
        }

        .btn-submit {
            background-color: #2c3e50;
            color:rgb(253, 156, 0);
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
            padding: 12px 30px;
            border-radius: 30px;
            width: 100%;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #f39c12;
            color: #2c3e50;
            transform: translateY(-2px);
        }

        .btn-submit:active {
            transform: translateY(1px);
        }

        .contact-container .form-group {
            margin-bottom: 20px;
        }

        .contact-container .form-group:last-child {
            margin-bottom: 0;
        }

        .footer-text {
            text-align: center;
            color: #2c3e50;
            font-size: 1.1rem;
            margin-top: 30px;
            font-weight: 300;
        }

        .footer-text a {
            color: #f39c12;
            text-decoration: none;
            font-weight: bold;
        }

        .footer-text a:hover {
            color: #2c3e50;
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .contact-container {
                padding: 30px;
            }

            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

<div class="contact-container">
    <h1>Свържете се с нас</h1>
    <form id="contact-form" action="./ajax/add_contact.php" method="POST">
    <div class="form-group">
        <label for="name">Вашето име:</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Въведете вашето име" required>
    </div>

    <div class="form-group">
        <label for="email">Вашият имейл:</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Въведете вашия имейл" required>
    </div>

    <div class="form-group">
        <label for="subject">Тема:</label>
        <input type="text" name="subject" id="subject" class="form-control" placeholder="Въведете тема" required>
    </div>

    <div class="form-group">
        <label for="message">Вашето съобщение:</label>
        <textarea name="message" id="message" class="form-control" rows="5" placeholder="Напишете вашето съобщение тук..." required></textarea>
    </div>

    <button type="submit" class="btn btn-submit">Изпрати</button>
</form>


    <div class="footer-text">
        <p>Ние ценим вашето време и усилия за свързване с нас. <br> За повече информация, не се колебайте да се свържете!</p>
        <p><a href="mailto:info@artgallery.com">info@artgallery.com</a></p>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>



</script>
</body>
</html>
