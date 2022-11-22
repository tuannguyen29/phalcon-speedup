<div class="form-login d-flex flex-column align-items-center row">
    <h3>Login</h3>
    <form class="col-md-6" action="/auth/login" method="post">
        <?php echo $form->render('csrf'); ?>
        <div class="form-group">
            <label for="email">Email *</label>
            <?php echo $form->render('email', ['value' => old('email')]); ?>
        </div>
        <div class="form-group">
            <label for="password">Password *</label>
            <?php echo $form->render('password'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->render('submit'); ?>
        </div>
    </form>
</div>