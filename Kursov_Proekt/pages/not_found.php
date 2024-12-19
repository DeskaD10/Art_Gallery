<?php
// страница 404 not found
http_response_code(404);
?>

<div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
    <div class="col-lg-6 p-3 p-lg-5 pt-lg-3">
        <h1 class="display-1 fw-bold lh-1 text-body-emphasis">Грешка 404</h1>
        <p class="lead">Страницата, която търсите, не е намерена.</p>
        <p class="lead">Не се притеснявайте! Можете да се върнете към <a href="?page=home" class="btn btn-outline-primary">началната страница</a> или да разгледате галерията.</p>
    </div>
    <div class="col-lg-6 p-0 overflow-hidden shadow-lg">
        <img src="https://upload.wikimedia.org/wikipedia/commons/e/e9/404_error_page_not_found.jpg" class="img-fluid rounded-lg-3" alt="404 Image">
    </div>
</div>
