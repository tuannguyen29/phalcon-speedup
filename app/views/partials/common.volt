<?php if (!empty($this->flashSession->has('success_msg'))) : ?>
    <script>
        PhalconCMS.showNotice("success", "<?php echo $this->flashSession->output(); ?>");
    </script>
<?php endif ?>

<?php if (!empty($this->flashSession->has('error_msg'))) : ?>
    <script>
        PhalconCMS.showNotice("error", "<?php echo $this->flashSession->output(); ?>");
    </script>
<?php endif ?>

