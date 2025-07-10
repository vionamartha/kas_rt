<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Kas RT - <?= $this->renderSection('title') ?></title>

  <!-- Custom fonts for SB Admin 2 -->
  <link href="<?= base_url('sb-admin-2/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700" rel="stylesheet" />

  <!-- SB Admin 2 CSS -->
  <link href="<?= base_url('sb-admin-2/css/sb-admin-2.min.css') ?>" rel="stylesheet" />
  <link href="<?= base_url('sb-admin-2/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" />
  
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?= $this->include('layout/sidebar') ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?= $this->include('layout/header') ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <?= $this->renderSection('content') ?>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <?= $this->include('layout/footer') ?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url('sb-admin-2/vendor/jquery/jquery.min.js') ?>"></script>
  <script src="<?= base_url('sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('sb-admin-2/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('sb-admin-2/js/sb-admin-2.min.js') ?>"></script>

  <!-- Page level plugins -->
  <script src="<?= base_url('sb-admin-2/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
  <script src="<?= base_url('sb-admin-2/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

  <!-- Page level custom scripts -->
  <script src="<?= base_url('sb-admin-2/js/demo/datatables-demo.js') ?>"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <?php if(session()->getFlashdata('toast_message')): ?>
  <script>
  document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
      toast: true,
      position: 'top-end',
      icon: <?= json_encode(session()->getFlashdata('toast_type') ?? 'success') ?>,
      title: <?= json_encode(session()->getFlashdata('toast_message')) ?>,
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    });
  });
  </script>
  <?php endif; ?>

  <?= $this->renderSection('scripts') ?>

</body>

</html>
