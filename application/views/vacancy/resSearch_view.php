<div style="padding-top: 20px; padding-bottom: 20px"><button class="btn btn-secondary" style="border-radius: 12px; margin-right: 300px" onclick="history.back()">Повернутись</button><b class="fs-2"><?= count($data) ?> доступних вакансій</b></div>
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

