<?php
// страница home
?>
 <section class="hero-section">
        <div class="hero-content">
        <h1 class="hero-title">
    Добре дошли в<br>
    Мистичния Свят на Изкуствата
</h1>
            <p class="hero-description">Открийте невероятни произведения на изкуството и вдъхновете се от творчеството на изключителни художници.</p>
            <a href="?page=gallery" class="btn btn-hero">Започнете пътуването</a>
        </div>
    </section>
    <!-- <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
        <img class="rounded-lg-3" src="https://culturizm.com/wp-content/uploads/2024/01/contemporary_art_styles.png.webp" alt="Примерна картина" width="720">
    </div>
</div> -->
<div class="mt-5">
    <h2 class="text-center mb-4 display-4" style="font-family: 'Arial', sans-serif; font-weight: bold; color: #f39c12;">Галерия</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <!-- Картина 1 -->
        <div class="col">
            <div class="card shadow-lg rounded-4 overflow-hidden painting-card">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/66/VanGogh-starry_night_ballance1.jpg/1280px-VanGogh-starry_night_ballance1.jpg" class="card-img-top painting-img" alt="Звездна нощ">
                <div class="card-body text-center">
                    <h5 class="card-title" style="font-weight: bold; font-size: 1.3rem;">Звездна нощ</h5>
                    <p class="card-text" style="color: #555;">Известната картина на Винсент ван Гог, която улавя нощното небе в движение.</p>
                    <a href="?page=gallery&filter=starry-night" class="btn btn-outline-warning btn-lg">Виж повече</a>
                </div>
            </div>
        </div>
        
        <!-- Картина 2 -->
        <div class="col">
            <div class="card shadow-lg rounded-4 overflow-hidden painting-card">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f4/The_Scream.jpg/800px-The_Scream.jpg" class="card-img-top painting-img" alt="Викът">
                <div class="card-body text-center">
                    <h5 class="card-title" style="font-weight: bold; font-size: 1.3rem;">Викът</h5>
                    <p class="card-text" style="color: #555;">Шедьовърът на Едвард Мунк, известен с емоционалната си сила и драматичност.</p>
                    <a href="?page=gallery&filter=the-scream" class="btn btn-outline-warning btn-lg">Виж повече</a>
                </div>
            </div>
        </div>
        
        <!-- Картина 3 -->
        <div class="col">
            <div class="card shadow-lg rounded-4 overflow-hidden painting-card">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Mona_Lisa%2C_by_Leonardo_da_Vinci%2C_from_C2RMF_retouched.jpg/800px-Mona_Lisa%2C_by_Leonardo_da_Vinci%2C_from_C2RMF_retouched.jpg" class="card-img-top painting-img" alt="Мона Лиза">
                <div class="card-body text-center">
                    <h5 class="card-title" style="font-weight: bold; font-size: 1.3rem;">Мона Лиза</h5>
                    <p class="card-text" style="color: #555;">Една от най-известните картини в света, създадена от Леонардо да Винчи.</p>
                    <a href="?page=gallery&filter=mona-lisa" class="btn btn-outline-warning btn-lg">Виж повече</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Стилове за по-интересен дизайн -->
<style>
    .painting-card {
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .painting-card:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    }

    /* .painting-img {
        transition: transform 0.3s ease;
    } */

    /* .painting-img:hover {
        transform: scale(1.1);
    } */

    .card-body {
        padding: 20px;
    }

    .btn-outline-warning {
        color: #f39c12;
        font-weight: bold;
    }

    .btn-outline-warning:hover {
        background-color: #f39c12;
        color: #2c3e50;
    }

    h2.display-4 {
        font-family: 'Arial', sans-serif;
        font-weight: bold;
        color: #f39c12;
        letter-spacing: 1px;
    }
</style>
