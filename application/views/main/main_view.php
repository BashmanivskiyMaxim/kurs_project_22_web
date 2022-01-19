
<?php $userModel = new model_main();
$userModel = $userModel->GetCurrentUser();
$admin = new model_main();
$admin = $admin->GetAdmin();
?>

<main>

    <div style="margin-bottom: 50px; margin-top: 50px" class="text-center"><h1 class="display-5 fw-bold">UPwork - працюємо на вас!</h1></div>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Допомога шукачам роботи</h5>
                    <a href="/main/searchjob" class="btn btn-success">Читати</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Допомога роботодавцям</h5>
                    <a href="/main/employment" class="btn btn-success">Читати</a>
                </div>
            </div>
        </div>

    </div>

    <?php if($userModel == $admin): ?>
        <a href="/main/add" class="btn btn-primary">Додати новину</a>
    <?php endif; ?>
    <?php
    foreach($data as $row){
    ?>
    <div class="">
        <div class="card-header">
        </div>
        <div class="card-body">
            <h5 class="card-title"><?= $row['title'] ?></h5>
            <p class="card-text"><?= $row['card_text'] ?></p>
            <div>
                <?php if($userModel == $admin): ?>
                    <a href="/main/edit?id=<?= $row['id'] ?>" class="btn btn-success">Редагувати</a>
                    <a href="/main/delete?id=<?= $row['id'] ?>" class="btn btn-danger">Видалити</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php } ?>
</main>

