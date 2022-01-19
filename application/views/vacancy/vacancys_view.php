
<form style="padding-top: 20px; padding-bottom: 20px" class="d-flex">
    <input class="form-control me-2" name="search" id="search" type="search" placeholder="Пошук вакансій" aria-label="Search">
    &#160;
    <button class="btn btn-light" type="submit">&#128269;</button>
</form>


<div id="data-container"></div>
<div id="pagination-container"></div>

<div style="padding-top: 20px; padding-bottom: 20px"><b class="fs-2"><?= $data1[0]['COUNT(*)'] ?> доступних вакансій</b></div>

<?php
$userModel = new model_vacancy();
$userModel = $userModel->GetCurrentUser();
$admin = new model_vacancy();
$admin = $admin->GetAdmin();
//?id=<?= $row['id']
foreach($data as $row){
    ?>
    <div class="card mb-3">
        <?php if($row['photo'] != 0): ?>
            <img style="height: 100px;" src="/images/vacancys/<?= $row['photo'] ?>" id="img1"  class="card-img-top" alt="">
        <?php endif; ?>
        <div class="card-body">
            <h3 class="card-title"><?= $row['title'] ?></h3>
            <div><p class="card-text"><?= $row['company'] ?></p><p class="card-text"><?= $row['city'] ?></p></div>
            <p class="card-text"><small class="text-muted"><?= $row['rubric'] ?>, <?= $row['employment'] ?></small></p>
            <p class="card-text"><small class="text-muted"><?= $row['created'] ?></small></p>
            <div>

                <a href="/vacancy/view?id=<?= $row['id'] ?>" class="btn btn-primary">Деталі</a>
                <?php if($row['user_id'] == $userModel or $userModel == $admin): ?>
                <a href="/vacancy/edit?id=<?= $row['id'] ?>" class="btn btn-success">Редагувати</a>
                <a href="/vacancy/delete?id=<?= $row['id'] ?>" class="btn btn-danger">Видалити</a>
                <?php endif; ?>
        </div>
        </div>
        <div class="card-footer text-muted">
            <h5><?php if($row['salary'] == 'По результатам співбесіди') {
                echo $row['salary'];
                }
                else echo $row['salary'] . '₴';
                ?></h5>
        </div>
    </div>

<?php } ?>

<nav style="padding-bottom: 30px; padding-top: 30px" aria-label="Page navigation example">
    <ul class="pagination">
        <?php for($i = 1; $i <= ($data1[0]['COUNT(*)'])/2; $i++){ ?>
            <li class="page-item"><a class="page-link" href="?page=<?=$i?>"><?=$i?></a></li>
        <?php } ?>
    </ul>
</nav>


