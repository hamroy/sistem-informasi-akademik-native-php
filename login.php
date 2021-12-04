<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIAKAD | Log in</title>
  <meta name="author" content="lokomedia.web.id">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="../../index2.html"><b>SISTEM INFORMASI</b> AKADEMIK</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Silahkan Login Pada Form dibawah ini</p>

      <form action="" method="post">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" name='a' placeholder="Username" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" name='b' placeholder="Password" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> Remember Me
              </label>
            </div>
          </div><!-- /.col -->
          <div class="col-xs-4">
            <button name='login' type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div><!-- /.col -->
        </div>
      </form>

    </div><!-- /.login-box-body -->
  </div><!-- /.login-box -->

  <!-- jQuery 2.1.4 -->
  <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="plugins/iCheck/icheck.min.js"></script>
  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
  </script>
</body>

</html>

<?php

if (isset($_POST[login])) {
  $passlain = anti_injection($_POST[b]);
  $data = md5(anti_injection($_POST[b]));
  $pass = hash("sha512", $data);
  $admin = mysqli_query($koneksi, "SELECT * FROM users WHERE username='" . anti_injection($_POST[a]) . "' AND password='$pass'");
  $guru = mysqli_query($koneksi, "SELECT * FROM guru WHERE nip='" . anti_injection($_POST[a]) . "' AND password='$passlain'");
  $siswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn='" . anti_injection($_POST[a]) . "' AND password='$passlain'");

  $hitungadmin = mysqli_num_rows($admin);
  $hitungguru = mysqli_num_rows($guru);
  $hitungsiswa = mysqli_num_rows($siswa);
  if ($hitungadmin >= 1) {
    $r = mysqli_fetch_array($admin);
    $_SESSION[id]     = $r[id_user];
    $_SESSION[namalengkap]  = $r[nama_lengkap];
    $_SESSION[level]    = $r[level];
    include "config/user_agent.php";
    mysqli_query($koneksi, "INSERT INTO users_aktivitas VALUES('','$r[id_user]','$ip','$user_browser $version','$user_os','$r[level]','" . date('H:i:s') . "','" . date('Y-m-d') . "')");
    echo "<script>document.location='index.php';</script>";
  } elseif ($hitungguru >= 1) {
    $r = mysqli_fetch_array($guru);
    $_SESSION[id]     = $r[nip];
    $_SESSION[namalengkap]  = $r[nama_guru];
    $_SESSION[level]    = 'guru';
    include "config/user_agent.php";
    mysqli_query($koneksi, "INSERT INTO users_aktivitas VALUES('','$r[nip]','$ip','$user_browser $version','$user_os','guru','" . date('H:i:s') . "','" . date('Y-m-d') . "')");
    echo "<script>document.location='index.php';</script>";
  } elseif ($hitungsiswa >= 1) {
    $r = mysqli_fetch_array($siswa);
    $_SESSION[id]     = $r[nisn];
    $_SESSION[namalengkap]  = $r[nama];
    $_SESSION[kode_kelas]     = $r[kode_kelas];
    $_SESSION[angkatan]     = $r[angkatan];
    $_SESSION[level]    = 'siswa';
    include "config/user_agent.php";
    mysqli_query($koneksi, "INSERT INTO users_aktivitas VALUES('','$r[nisn]','$ip','$user_browser $version','$user_os','siswa','" . date('H:i:s') . "','" . date('Y-m-d') . "')");
    echo "<script>document.location='index.php';</script>";
  } else {
    echo "<script>window.alert('Maaf, Anda Tidak Memiliki akses');
                                  window.location=('index.php?view=login')</script>";
  }
}
?>