<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login Kas RT</title>

  <!-- Bootstrap 4/5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- SB Admin 2 Custom CSS -->
  <link href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.4/css/sb-admin-2.min.css" rel="stylesheet" />
</head>

<body class="bg-gradient-primary">

  <div class="container">
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block">
              <img src="<?= base_url('assets/images/warga.png') ?>" class="img-fluid" alt="Login Image">
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                  </div>

                  <!-- Flash Error Message -->
                  <?php if (session()->getFlashdata('error')): ?>
                  <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                  </div>
                  <?php endif; ?>

                  <!-- Login Form -->
                  <form method="post" action="/auth/dologin">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user rounded-pill" id="username" name="username" placeholder="Enter Email Address..." required />
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user rounded-pill" id="password" name="password" placeholder="Password" required />
                    </div>

                    <!-- Remember Me Checkbox -->
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck" name="remember">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block rounded-pill">Login</button>
                  </form>

                  <hr>
                  <!-- Other Links (optional) -->
                  <div class="text-center">
                    <a class="small" href="#">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="#">Create an Account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Bootstrap and SB Admin 2 JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.4/js/sb-admin-2.min.js"></script>

  <script>
    // Popup Greeting
    <?php if (session()->get('clear_popup')): ?>
      session()->set('popupShown', false);
    <?php endif; ?>

    window.addEventListener('DOMContentLoaded', (event) => {
      const username = "<?= session()->get('username') ?>"; // Mendapatkan nama pengguna dari session
      const popupShown = "<?= session()->get('popupShown') ?>"; 

      if (username && popupShown === 'false') { 
          alert('Selamat datang, ' + username); 
          session()->set('popupShown', 'true'); 
      }
    });
  </script>

</body>

</html>
