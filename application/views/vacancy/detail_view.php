<?php
//?id=<?= $row['id']
?>
<button class="btn btn-secondary" style="border-radius: 12px; margin-top: 25px; margin-bottom: 25px" onclick="history.back()">Повернутись</button>
<div style="padding-top: 20px; padding-bottom: 20px" class="card mb-3">
    <?php if($data[0]['photo'] != 0 && $data[0]['photo'] != NULL): ?>
        <img style="height: 100px;" src="/images/vacancys/<?= $data[0]['photo'] ?>" id="img1"  class="card-img-top" alt="">
    <?php endif; ?>
    <div class="card-body">
        <h1 class="card-title"><?= $data[0]['title'] ?></h1>
        <div><p class="card-text"><?= $data[0]['company'] ?></p><p class="card-text"><?= $data[0]['city'] ?></p></div>
        <p class="card-text"><small class="text-muted"><?= $data[0]['created'] ?> <?= $data[0]['employment'] ?></small></p>
        <p class="card-text fs-3 text"><?= $data[0]['descriptions'] ?></p>
    </div>
    <div class="card-footer text-muted text-end">
        <h5><?php if($data[0]['salary'] == 'По результатам співбесіди') {
                echo $data[0]['salary'];
            }
            else echo $data[0]['salary'] . '₴';
            ?></h5>
        <h5><?= $data[0]['contacts'] ?></h5>
    </div>


</div>