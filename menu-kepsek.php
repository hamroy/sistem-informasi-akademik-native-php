<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="<?php echo $foto; ?>" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p><?php echo $nama; ?></p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>

  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
    <li class="header" style='color:#fff; text-transform:uppercase; border-bottom:2px solid #00c0ef'>MENU <?php echo $level; ?></li>
    <li><a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
    <li class="treeview">
      <a href="#"><i class="fa fa-user"></i> <span>Data Pengguna</span><i class="fa fa-angle-left pull-right"></i></a>
      <ul class="treeview-menu">
        <li><a href="index.php?view=siswa"><i class="fa fa-circle-o"></i> Data Siswa</a></li>
        <li><a href="index.php?view=guru"><i class="fa fa-circle-o"></i> Data Guru</a></li>
        <!-- <li><a href="index.php?view=wakilkepala"><i class="fa fa-circle-o"></i> Data Kepala Sekolah</a></li> -->
      </ul>
    </li>
    <li class="treeview">
      <a href="#"><i class="fa fa-th"></i> <span>Data Master</span><i class="fa fa-angle-left pull-right"></i></a>
      <ul class="treeview-menu">
        <li><a href="index.php?view=kelas"><i class="fa fa-circle-o"></i> Data Kelas</a></li>
        <li><a href="index.php?view=matapelajaran"><i class="fa fa-circle-o"></i> Data Mata Pelajaran</a></li>
        <li><a href="index.php?view=jadwalpelajaran"><i class="fa fa-circle-o"></i> Data Jadwal Pelajaran</a></li>
      </ul>
    </li>
    <li class="treeview">
      <a href="#"><i class="fa fa-th-large"></i> <span>Data Absensi</span><i class="fa fa-angle-left pull-right"></i></a>
      <ul class="treeview-menu">
        <li><a href="index.php?view=absensiswa"><i class="fa fa-circle-o"></i> Absensi Siswa</a></li>
        <li><a href="index.php?view=absenguru"><i class="fa fa-circle-o"></i> Absensi Guru</a></li>
      </ul>
    </li>
    <li><a href="index.php?view=bahantugas"><i class="fa fa-file"></i><span>Bahan dan Tugas</span></a></li>
    <li><a href="index.php?view=soal"><i class="fa fa-users"></i><span>Quiz / Ujian Online</span></a></li>
    <li><a href="index.php?view=journalkbm"><i class="fa fa-tags"></i><span>Journal KBM</span></a></li>
    <li><a href="index.php?view=forum"><i class="fa fa-th-list"></i> <span>Forum Diskusi</span></a></li>
    <li><a href="index.php?view=raportcetak"><i class="fa fa-calendar"></i> <span>Laporan Nilai</span></a></li>
    <!-- <li><a href="index.php?view=dokumentasi"><i class="fa fa-book"></i> <span>Documentation</span></a></li> -->
  </ul>
</section>