<link href="/css/styles.css" rel="stylesheet">
<p class="fs-1">Форма реєстрації</p>
<div>
    <form method="post">
        <div class="mb-4">
            <label for="exampleInput1" class="form-label">Фамілія</label>
            <input type="text" name="last_name" class="form-control" id="exampleInput1">
        </div>
        <div class="mb-4">
            <label for="exampleInput2" class="form-label">Ім'я</label>
            <input type="text" name="first_name" class="form-control" id="exampleInput2">
        </div>
        <div class="mb-4">
            <label for="email" class="form-label">Електронна адреса</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Ваш електронний адрес ніколи не буде використаний в приватних цілях.</div>
        </div>
        <div class="mb-4">
            <label for="password_field" class="form-label">Пароль</label>
            <input type="password" name="password" class="form-control" id="password_field">
        </div>
        <div class="mb-4">
            <label for="exampleInput3" class="form-label">Про себе</label>
            <textarea name="resume" id="default"></textarea>
        </div>
        <button disabled type="submit" name="submit" id="btn" class="btn btn-primary">Зареєструватися</button>
        <div style="margin-top: 20px">
            <a class="link" href="/user/login" role="button">Вже зареєстровані ?, увійдіть до акаунту</a>
        </div>
    </form>
</div>
<div id="message">
    <h3>Пароль повинен складатись з:</h3>
    <p id="letter" class="invalid">Наявність символів <b>нижнього регістру</b></p>
    <p id="capital" class="invalid">Наявність символів <b>верхнього регістру</b></p>
    <p id="number" class="invalid">Наявність <b>цифр</b></p>
    <p id="length" class="invalid">Мінімум <b>8 символів</b></p>
    <p id="specials" class="invalid">Відсутність <b>спеціальних символів</b></p>
</div>
<div id="message_email">
    <h3>Електронна почта введена некоректно:</h3>
    <p id="email_message" class="invalid">Почта відповідає загальноприйнятому формату</p>
</div>
<script src="https://cdn.tiny.cloud/1/fiugkmpyafwkowbwl77b8cjm6x936ii316mzcrt0cijrjyb1/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#default'
    });
</script>
<script src="/js/password_acces.js"></script>
