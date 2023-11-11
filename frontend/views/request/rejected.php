<div class="container-wrapper flex flex-justify-center">
    <div class="content flex flex-column">
        <?php foreach($errors as $key => $error): ?>
            <div class="row"><?php echo $error[0]; ?></div>
        <?php endforeach; ?>
    </div>
</div>
