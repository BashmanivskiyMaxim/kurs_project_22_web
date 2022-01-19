<link href="/css/styles.css" rel="stylesheet">
<p class="fs-2">Створення резюме</p>
<div>
    <form method="post" enctype="multipart/form-data" style="margin-bottom: 20px">
        <div class="mb-4">
            <label for="exampleInput1" class="form-label">Професія, посада на яку ви претедуєте</label>
            <input type="text" required name="job_pos" class="form-control" id="exampleInput1">
        </div>
        <div class="mb-4">
            <label for="exampleInput2" class="form-label">Ім'я</label>
            <input type="text" required name="first_name" value="<?= $_SESSION['first_name'] ?>" class="form-control" id="exampleInput2">
        </div>
        <div class="mb-4">
            <label for="exampleInput2" class="form-label">Прізвище</label>
            <input type="text" required name="last_name" value="<?= $_SESSION['last_name'] ?>" class="form-control" id="exampleInput2">
        </div>
        <div class="mb-4">
            <label for="exampleInput2" class="form-label">Ваш вік</label>
            <input type="number" min="18" max="120" required name="age" class="form-control" id="exampleInput2">
        </div>
        <div class="mb-4">
            <label for="email" class="form-label">Електронна адреса</label>
            <input type="email" name="email" class="form-control" id="email" value="<?= $_SESSION['email'] ?>" required pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}" aria-describedby="emailHelp">
        </div>
        <div class="mb-4">
            <label for="email" class="form-label">Місто, в якому ви хочете працювати</label>
            <?php $cities = array('Київ','Житомир', 'Харків','Дніпро','Одеса','Донецьк','Запоріжжя','Львів','Кривий Ріг','Миколаїв','Маріуполь','Луганськ','Макіївка','Вінниця','Сімферополь','Севастополь','Херсон','Полтава','Чернігів','Черкаси','Суми','Горлівка','Хмельницький','Камянське','Кропивницький','Рівне','Чернівці','Кременчук','Тернопіль','Івано-Франківськ','Луцьк','Біла Церква','Краматорськ','Мелітополь','Керч','Нікополь','Словянськ','Бердянськ','Ужгород','Умань','Бердичів','Шостка','Бровари','Новоград-Волинський');?>
            <select name="city" required id="city" class="form-select">
                <?php
                foreach($cities as $city){
                    echo '<option value="'.$city.'">'.$city.'</option>';
                }
                ?>
            </select>
        </div>
        <label for="" class="form-label">Заробітна плата на яку ви очікуєте</label>
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1">₴</span>
            <input required type="text" name="salary_exp" class="form-control" id="salary">
        </div>
        <div class="mb-4">
            <input class="form-check-input" type="checkbox" value="" id="check">
            <label class="form-check-label" for="flexCheckDefault">
                Не вказано
            </label>
        </div>
        <div class="mb-4">
            <label for="email" class="form-label">Розділ</label>
            <?php $rubric = array('Hr-спеціалісти','Сфера обслуговування', 'Робочі спеціальності, виробництво','Роздрібна торгівля','IT, компютери, інтернет','Логістика, склад, ЗЕД','Адмiнiстрацiя, керівництво середньої ланки','Готельно-ресторанний бізнес, туризм','Транспорт, автобізнес','Бухгалтерія, аудит','Секретаріат, діловодство, АГВ','Будівництво, архітектура','Маркетинг, реклама, PR','Медицина, фармацевтика','Телекомунікації та звязок','Фінанси, банк','Освіта, наука','Дизайн, творчість','Краса, фітнес, спорт','ЗМІ, видавництво, поліграфія','Охорона, безпека','Топменеджмент, керівництво вищої ланки','Сільське господарство, агробізнес','Юриспруденція','Страхування');?>
            <select name="job_exp_rubric" required id="rubric" class="form-select">
                <?php
                foreach($rubric as $r){
                    echo '<option value="'.$r.'">'.$r.'</option>';
                }
                ?>
            </select>
        </div>
        <div class="mb-4">
            <label for="email" class="form-label">Зайнятість</label>
            <?php $rubric = array('повна зайнятість','стажування / практика', 'неповна зайнятість','віддалена робота','проектна робота','позмінна робота');?>
            <select name="employment" required id="rubric" class="form-select">
                <?php
                foreach($rubric as $r){
                    echo '<option value="'.$r.'">'.$r.'</option>';
                }
                ?>
            </select>
        </div>
        <label for="exampleInput3" class="form-label">Номер телефона</label>
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1">+38</span>
            <input class="form-control" required type="tel" id="phone" name="contacts" placeholder="000-00-00-000" pattern="[0-9]{3}[0-9]{2}[0-9]{2}[0-9]{3}">
        </div>
        <div class="mb-4">
            <label class="form-label">Деталі про досвід роботи:</label>
            <textarea name="descriptions" id="default"></textarea>
        </div>
        <div class="mb-4">
            <label for="formFile" class="form-label">Встановіть вашу фотографію</label>
            <input name="photo" accept="image/jpeg,image/png" type="file" id="formFile">
        </div>
        <div id="message_email">
            <h3>Електронна почта введена некоректно:</h3>
            <p id="email_message" class="invalid">Почта відповідає загальноприйнятому формату</p>
        </div>
        <button type="submit" name="submit" id="btn" class="btn btn-primary">Відправити</button>
    </form>
</div>
<script src="/js/resume.js"></script>
<script src="https://cdn.tiny.cloud/1/fiugkmpyafwkowbwl77b8cjm6x936ii316mzcrt0cijrjyb1/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#default'
    });
</script>
<script src="/js/password_acces.js"></script>

