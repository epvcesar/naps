<?= $this->extend("layout/master") ?>

<?= $this->section("content") ?>

<div class="alert alert-danger" role="alert">

    <?php echo $dadosAcesso ?>

</div>
<?= $this->endSection() ?>
<!-- /.content -->


<!-- page script -->
<?= $this->section("pageScript") ?>

<?= $this->endSection() ?>