<div class="form-login d-flex flex-column align-items-center row">
    <h3>Register</h3>
    <form class="col-md-6" action="/auth/register" method="post">
        <?php echo $form->render('csrf'); ?>
        <div class="form-group">
            <label for="firstname">First Name *</label>
            <?php echo $form->render('first_name', ['value' => old('first_name')]); ?>
        </div>
        <div class="form-group">
            <label for="lastname">Last Name *</label>
            <?php echo $form->render('last_name', ['value' => old('last_name')]); ?>
        </div>
        <div class="form-group">
            <label for="email">Email *</label>
            <?php echo $form->render('email', ['value' => old('email')]); ?>
        </div>
        <div class="form-group">
            <label for="password">Password *</label>
            <?php echo $form->render('password', ['value' => '']); ?>
        </div>
        <div class="form-group">
            <?php echo $form->render('submit'); ?>
        </div>
    </form>
</div>