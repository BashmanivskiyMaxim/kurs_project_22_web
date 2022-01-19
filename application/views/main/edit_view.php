<p class="fs-2">Редагування новини</p>
<div>
    <form method="post" enctype="multipart/form-data" style="margin-bottom: 20px">
        <div class="mb-4">
            <label for="email" class="form-label">Заголовок</label>
            <input name="title" value="<?= $data[0]['title']?>" class="form-control" type="text" id="">
        </div>
        <div class="mb-4">
            <label class="form-label">Деталі:</label>
            <textarea name="card_text" id="default"><?= $data[0]['card_text'] ?></textarea>
        </div>
        <button type="submit" name="submit" id="btn" class="btn btn-primary">Редагувати</button>
    </form>
</div>
<script src="https://cdn.tiny.cloud/1/fiugkmpyafwkowbwl77b8cjm6x936ii316mzcrt0cijrjyb1/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#default'
    });
</script>


