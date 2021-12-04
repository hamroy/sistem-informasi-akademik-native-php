              <ul class="nav navbar-nav">
              <?php
                $menu = mysqli_query($koneksi,"SELECT * FROM menu where id_parent='0' AND aktif='Ya' AND status='psb' ORDER BY urutan ASC");
                while($dataMenu = mysqli_fetch_assoc($menu)){
                  $menu_id = $dataMenu['id_menu'];
                  $submenu = mysqli_query($koneksi,"SELECT * FROM menu WHERE id_parent='$menu_id' AND aktif='Ya' AND status='psb' ORDER BY urutan ASC");
                  if(mysqli_num_rows($submenu) == 0){
                    echo '<li><a href="'.$dataMenu['link'].'"><i class="glyphicon glyphicon-'.$dataMenu['icon'].'"></i> '.$dataMenu['nama_menu'].'</a></li>';
                  }else{
                    echo '
                    <li class="dropdown">
                      <a href="'.$dataMenu['link'].'" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-'.$dataMenu['icon'].'"></i> '.$dataMenu['nama_menu'].' <span class="caret"></span></a>
                      <ul class="dropdown-menu">';
                      while($dataSubmenu = mysqli_fetch_assoc($submenu)){
                        echo '<li><a href="'.$dataSubmenu['link'].'">'.$dataSubmenu['nama_menu'].'</a></li>';
                      }
                    echo '
                      </ul>
                    </li>
                    ';
                  }
                }
              ?>
              <li><a href="#" data-toggle="modal" data-target="#kode"><i class="glyphicon glyphicon-list-alt"></i> Pendaftaran</a></li>
            </ul>