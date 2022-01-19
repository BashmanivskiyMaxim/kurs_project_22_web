<p class="fs-1">Акаунт</p>
<div>
    <form method="post">
        <div class="mb-4">
            <label for="exampleInput1" class="form-label">Фамілія</label>
            <input type="text" name="last_name" value="<?php echo $_SESSION["last_name"]; ?>" class="form-control" id="exampleInput1">
        </div>
        <div class="mb-4">
            <label for="exampleInput2" class="form-label">Ім'я</label>
            <input type="text" name="first_name" class="form-control" value="<?php echo $_SESSION["first_name"]; ?>" id="exampleInput2">
        </div>
        <div class="mb-4">
            <label for="email" class="form-label">Електронна адреса</label>
            <input type="email" readonly="readonly" name="email" class="form-control" id="email" value="<?php echo $_SESSION["email"]; ?>" aria-describedby="emailHelp">
        </div>
        <div class="mb-4">
            <label for="exampleInput3" class="form-label">Про себе</label>
            <textarea name="resume" class="form-control" id="default"><?php echo $_SESSION["resume"]; ?></textarea>
        </div>
        <button type="submit" name="submit1" class="btn btn-primary">Внести зміни</button>
        <a class="btn btn-dark" href="/user/deleteAc">Видалити акаунт</a>
        <a class="btn btn-danger" href="/user/logout" role="button">Вийти</a>
    </form>
    <div style="padding-top: 20px; padding-bottom: 20px"><b class="fs-2">Ваші вакансії та резюме:</b></div>

    <div id="vacdiv">
    <?php
    //?id=<?= $row['id']
    if(!empty($data)){
        foreach($data as $row){
            ?>

            <div class="card mb-3">
                <?php if($row['photo'] != 0): ?>
                    <img style="height: 100px;" src="/images/vacancys/<?= $row['photo'] ?>" id="img1"  class="card-img-top" alt="">
                <?php endif; ?>
                <div class="card-body">
                    <h3 class="card-title"><?= $row['title'] ?></h3>
                    <div><p class="card-text"><?= $row['company'] ?></p><p class="card-text"><?= $row['city'] ?></p></div>
                    <p class="card-text"><small class="text-muted"><?= $row['created'] ?></small></p>
                    <div>
                        <a href="/vacancy/view?id=<?= $row['id'] ?>" class="btn btn-primary">Деталі</a>
                        <a href="/vacancy/edit?id=<?= $row['id'] ?>" class="btn btn-success">Редагувати</a>
                        <a href="/vacancy/delete?id=<?= $row['id'] ?>" class="btn btn-danger">Видалити</a>
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
    <?php }else echo "<div class='display-1 text-muted'>Схоже ви ще не розміщували вакансії або резюме на сайті 😓</b></div>" ?>

    </div>

    <div id="resdiv">
        <?php
        if(!empty($data1)){

        //?id=<?= $row['id']
        foreach($data1 as $row){
            ?>
            <div class="d-flex justify-content-center">
                <div class="card mb-3" style="max-width: 750px;">
                    <div class="row g-0">
                        <?php if($row['photo'] != 0): ?>
                            <div class="col-md-4">
                                <img style="min-height: 208px; max-height: 220px" src="/images/resumes/<?= $row['photo'] ?>" id="img1"  class="img-fluid rounded-start" alt="">
                            </div>
                        <?php else: ?>
                            <img style="max-height: 220px; max-width: 200px " src="/images/resumes/defoult1.png" id="img1"  class="img-fluid rounded-start" alt="">
                        <?php endif; ?>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row['job_pos'] ?>, <?= $row['city'] ?></h5>
                                <p class="card-text"><?= $row['last_name'] ?> <?= $row['first_name'] ?>, <?= $row['age'] ?></p>
                                <p class="card-text"><small class="text-muted"><?= $row['updated_at'] ?></small></p>
                                <div>
                                    <a href="/resume/view?id=<?= $row['id'] ?>" class="btn btn-primary">Деталі</a>
                                    <a href="/resume/edit?id=<?= $row['id'] ?>" class="btn btn-success">Редагувати</a>
                                    <a href="/resume/delete?id=<?= $row['id'] ?>" class="btn btn-danger">Видалити</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>

        <?php } ?>

    </div>

</div>
<script src="https://cdn.tiny.cloud/1/fiugkmpyafwkowbwl77b8cjm6x936ii316mzcrt0cijrjyb1/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#default'
    });
</script>


