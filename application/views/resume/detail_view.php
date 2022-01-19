<?php
//?id=<?= $row['id']
?>
<button class="btn btn-secondary" style="border-radius: 12px; margin-top: 25px" onclick="history.back()">Повернутись</button>
<div style="padding-top: 20px; padding-bottom: 20px" class="d-flex justify-content-center">
    <div class="card border-secondary border  border-3 mb-3" style="max-width: 750px;">
        <div class="card-header bg-transparent text-end"><small class="text-muted">+380 <?= $data[0]['contacts'] ?>, </small>
            <b class="text-muted"><?= $data[0]['email'] ?></b></div>
        <div class="row g-0">
            <?php if($data[0]['photo'] != 0): ?>
                <div class="col-md-4">
                    <img style="min-height: 208px; max-height: 220px" src="/images/resumes/<?= $data[0]['photo'] ?>" id="img1"  class="img-fluid rounded-start" alt="">
                </div>
            <?php else: ?>
                <img style="max-height: 220px; max-width: 200px " src="/images/resumes/defoult1.png" id="img1"  class="img-fluid rounded-start" alt="">
            <?php endif; ?>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $data[0]['job_pos'] ?>, <?= $data[0]['city'] ?></h5>
                    <p class="card-text"><?= $data[0]['last_name'] ?> <?= $data[0]['first_name'] ?>, <?= $data[0]['age'] ?> років</p>
                    <p class="card-text"><small class="text-muted"><?= $data[0]['updated_at'] ?></small></p>
                    <p class="card-text"><?= $data[0]['descriptions'] ?></p>
                    <b class="card-text">Очікувана зарплата: <?php if($data[0]['salary_exp'] == 'Не вказано') {
                            echo $data[0]['salary_exp'];
                        }
                        else echo $data[0]['salary_exp'] . '₴';
                        ?></b>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <small class="text-muted">Редаговано: <?= $data[0]['updated_at'] ?></small>
        </div>
    </div>
</div>


</div>
