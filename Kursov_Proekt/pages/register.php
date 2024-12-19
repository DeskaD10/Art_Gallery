<?php
    // страница register
?>

<div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
    <div class="col-lg-6 p-3 p-lg-5 pt-lg-3">
        <h1 class="display-4 fw-bold lh-1 text-body-emphasis">Регистрация в системата</h1>
        <p class="lead">Създайте акаунт, за да се наслаждавате на всичко, което нашата онлайн галерия предлага.</p>
    </div>
    <div class="col-lg-6 p-0 overflow-hidden shadow-lg">
        <form class="border rounded p-4 w-75 mx-auto" method="POST" action="./handlers/handle_register.php">
            <div class="mb-3">
                <label for="names" class="form-label">Имена</label>
                <input type="text" class="form-control" id="names" name="names" value="<?php echo $flash['data']['names'] ?? '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Имейл</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $flash['data']['email'] ?? '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Парола</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="repeat_password" class="form-label">Повтори парола</label>
                <input type="password" class="form-control" id="repeat_password" name="repeat_password" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Тип на потребител</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_admin" id="user_radio" value="1" checked>
                    <label class="form-check-label" for="user_radio">Потребител</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_admin" id="admin_radio" value="2">
                    <label class="form-check-label" for="admin_radio">Администратор</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mx-auto">Регистрирай се</button>
        </form>
    </div>
</div>
