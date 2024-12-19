<?php 
    // страница login
?>

<div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
    <div class="col-lg-6 p-3 p-lg-5 pt-lg-3">
        <h1 class="display-4 fw-bold lh-1 text-body-emphasis">Вход в системата</h1>
        <p class="lead">Влезте в своя акаунт, за да разглеждате и купувате произведения на изкуството.</p>
    </div>
    <div class="col-lg-6 p-0 overflow-hidden shadow-lg">
        <form class="border rounded p-4 w-75 mx-auto" method="POST" action="./handlers/handle_login.php">
            <div class="mb-3">
                <label for="email" class="form-label">Имейл</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $_COOKIE['user_email'] ?? '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Парола</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary mx-auto">Вход</button>
        </form>
    </div>
</div>

