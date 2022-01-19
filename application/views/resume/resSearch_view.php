<div class="d-flex justify-content-center" style="padding-top: 20px; padding-bottom: 20px"><button class="btn btn-secondary" style="border-radius: 12px; margin-right: 300px" onclick="history.back()">Повернутись</button><b class="fs-2"><?= count($data) ?> доступних резюме</b></div>

<?php
//?id=<?= $row['id']
$userModel = new model_resume();
$userModel = $userModel->GetCurrentUser();
$admin = new model_resume();
$admin = $admin->GetAdmin();
foreach($data as $row){
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
                            <?php if($row['user_id'] == $userModel || $userModel == $admin): ?>
                                <a href="/resume/edit?id=<?= $row['id'] ?>" class="btn btn-success">Редагувати</a>
                                <a href="/resume/delete?id=<?= $row['id'] ?>" class="btn btn-danger">Видалити</a>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


<?php } ?>

<script>
    $(".hBack").on("click", function(e){
        e.preventDefault();
        window.history.back();
    });
</script>

