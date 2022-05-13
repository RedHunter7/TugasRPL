<?php
$servername = "localhost";
$username = "username";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

session_start();
   
$admin_check = $_SESSION['login_admin'];

$ses_sql = mysqli_query($conn, "select username from Admin where username = '$admin_check' ");
   
$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
$login_session = $row['username'];
   
if(!isset($_SESSION['login_admin'])) {
  header("location:index.php");
  die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['submit'])) {
    if ($_POST['submit'] == "create_dosen") {
      $create_dosen = "INSERT INTO `Dosen` (`NIP`, `nama`, `is_delete`) 
      VALUES ('" . $_POST['id_dosen'] . "','" . $_POST['nama_dosen'] . "', b'0') ";
      if (mysqli_query($conn, $create_dosen)) {
        echo "New record created successfully";
      } else {
        echo "Error: " . "ketika insert data" . "<br>";
      }
    }
  
    if ($_POST['submit'] == "create_mk") {
      $create_dosen = "INSERT INTO `Mata Kuliah` (`kd_mk`, `nama`, `is_delete`) 
      VALUES ('" . $_POST['kd_mk'] . "','" . $_POST['nama_mk'] . "', b'0') ";
      if (mysqli_query($conn, $create_dosen)) {
        echo "New record created successfully";
      } else {
        echo "Error: " .  "ketika insert data" . "<br>" ;
      }
    }
  
    if ($_POST['submit'] == "create_jadwal") {
      $create_jadwal = "INSERT INTO `Jadwal Mengajar` (`kd_jadwal`, `nip_dosen`, `kd_mk`, `hari`, `is_delete`) 
      VALUES (NULL, '" . $_POST['dosen'] . "','" . $_POST['mk'] . "', '" . $_POST['hari'] . "', b'0') ";
      if (mysqli_query($conn, $create_jadwal)) {
        echo "New record created successfully";
      } else {
        echo "Error: " .  "ketika insert data" . "<br>";
      }
    }
  }
  elseif(isset($_POST['soft_delete'])) {
    if ($_POST['soft_delete'] == "soft_delete_dosen") {
      $soft_delete_dosen = "UPDATE `Dosen` SET `is_delete` = b'1' WHERE `Dosen`.`NIP` =". $_POST['nip'];
      if (mysqli_query($conn, $soft_delete_dosen)) {
        echo "record deleted successfully";
      } else {
        echo "Error: " . $soft_delete_dosen . "<br>" . mysqli_error($conn);
      }
    }
    
    if ($_POST['soft_delete'] == "soft_delete_mk") {
      $soft_delete_mk = "UPDATE `Mata Kuliah` SET `is_delete` = b'1' WHERE `Mata Kuliah`.`kd_mk` =". $_POST['kd_mk'];
      if (mysqli_query($conn, $soft_delete_mk)) {
        echo "record deleted successfully";
      } else {
        echo "Error: " . $soft_delete_mk . "<br>" . mysqli_error($conn);
      }
    }

    if ($_POST['soft_delete'] == "soft_delete_jadwal") {
      $soft_delete_jadwal = "UPDATE `Jadwal Mengajar` SET `is_delete` = b'1' 
      WHERE `Jadwal Mengajar`.`kd_jadwal` =". $_POST['kd_jadwal'];
      if (mysqli_query($conn, $soft_delete_jadwal)) {
        echo "record deleted successfully";
      } else {
        echo "Error: " . $soft_delete_jadwal . "<br>" . mysqli_error($conn);
      }
    }
  }
  elseif(isset($_POST['edit'])) {
    if ($_POST['edit'] == "edit_dosen") {
      $edit_dosen = "UPDATE `Dosen` SET `nama` = '" . $_POST['nama_dosen'] . "' 
      WHERE `Dosen`.`NIP` =". $_POST['nip'];
      if (mysqli_query($conn, $edit_dosen)) {
        echo "record edited successfully";
      } else {
        echo "Error: " . $edit_dosen . "<br>" . mysqli_error($conn);
      }
    }
    
    if ($_POST['edit'] == "edit_mk") {
      $edit_mk = "UPDATE `Mata Kuliah` SET `nama` = '" . $_POST['nama_mk'] . "' 
      WHERE `Mata Kuliah`.`kd_mk` =". $_POST['kd_mk'];
      if (mysqli_query($conn, $edit_mk)) {
        echo "record edited successfully";
      } else {
        echo "Error: " . $edit_mk . "<br>" . mysqli_error($conn);
      }
    }

    if ($_POST['edit'] == "edit_jadwal") {
      $edit_jadwal = "UPDATE `Jadwal Mengajar` SET `nip_dosen` = ". $_POST['dosen'] .", 
      `kd_mk` = " . $_POST['mk'] . ", `hari` = '" . $_POST['hari'] . "'   
      WHERE `Jadwal Mengajar`.`kd_jadwal` =". $_POST['kd_jadwal'];
      if (mysqli_query($conn, $edit_jadwal)) {
        echo "record edited successfully";
      } else {
        echo "Error: " . $edit_jadwal . "<br>" . mysqli_error($conn);
      }
    } 
  }
  elseif (isset($_POST['restore'])) {
    if ($_POST['restore'] == "restore_dosen") {
      $restore_dosen = "UPDATE `Dosen` SET `is_delete` = b'0' WHERE `Dosen`.`NIP` =". $_POST['nip'];
      if (mysqli_query($conn, $restore_dosen)) {
        echo "record restored successfully";
      } else {
        echo "Error: " . $restore_dosen . "<br>" . mysqli_error($conn);
      }
    }

    if ($_POST['restore'] == "restore_mk") {
      $restore_mk = "UPDATE `Mata Kuliah` SET `is_delete` = b'0' WHERE `Mata Kuliah`.`kd_mk` =". $_POST['kd_mk'];
      if (mysqli_query($conn, $restore_mk)) {
        echo "record restored successfully";
      } else {
        echo "Error: " . $restore_mk . "<br>" . mysqli_error($conn);
      }
    }

    if ($_POST['restore'] == "restore_jadwal") {
      $restore_jadwal = "UPDATE `Jadwal Mengajar` SET `is_delete` = b'0' 
      WHERE `Jadwal Mengajar`.`kd_jadwal` =". $_POST['kd_jadwal'];
      if (mysqli_query($conn, $restore_jadwal)) {
        echo "record deleted successfully";
      } else {
        echo "Error: " . $restore_jadwal . "<br>" . mysqli_error($conn);
      }
    }
  }

  elseif (isset($_POST['hard_delete'])) {
    if ($_POST['hard_delete'] == "hard_delete_dosen") {
      $hard_delete_dosen = "DELETE FROM `Dosen` WHERE `Dosen`.`NIP` = ". $_POST['nip'];
      if (mysqli_query($conn, $hard_delete_dosen)) {
        echo "record Deleted Permanently";
      } else {
        echo "Error: " . $hard_delete_dosen . "<br>" . mysqli_error($conn);
      }
    }

    if ($_POST['hard_delete'] == "hard_delete_mk") {
      $hard_delete_mk = "DELETE FROM `Mata Kuliah` WHERE `Mata Kulliah`.`kd_mk` = ". $_POST['kd_mk'];
      if (mysqli_query($conn, $hard_delete_mk)) {
        echo "record Deleted Permanently";
      } else {
        echo "Error: " . $hard_delete_mk . "<br>" . mysqli_error($conn);
      }
    }

    if ($_POST['hard_delete'] == "hard_delete_jadwal") {
      $hard_delete_jadwal = "DELETE FROM `Jadwal Mengajar` 
      WHERE `Jadwal Mengajar`.`kd_jadwal` = ". $_POST['kd_jadwal'];
      if (mysqli_query($conn, $hard_delete_jadwal)) {
        echo "record Deleted Permanently";
      } else {
        echo "Error: " . $hard_delete_jadwal . "<br>" . mysqli_error($conn);
      }
    }
  }
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Document</title>
</head>
<body>
  <nav>
    <div class="nav-wrapper">
      <a href="#!" class="brand-logo">Welcome <?php echo $login_session; ?></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="logout.php" class="waves-effect waves-light btn">Logout</a></li>
      </ul>
    </div>
  </nav>

  <div class="row">
    <div class="col s12">
      <ul class="tabs tabs-fixed-width" id="tab">
        <li class="tab col s3"><a href="#test1">Dosen</a></li>
        <li class="tab col s3"><a href="#test2">Mata Kuliah</a></li>
        <li class="tab col s3"><a href="#test3">Jadwal Mengajar</a></li>
        <li class="tab col s3"><a href="#test4">Trash</a></li>
      </ul>
    </div>
    <div id="test1" class="col s12">
      <table class="striped hightlight" id="dosen">
        <thead>
          <tr>
              <th>NIP</th>
              <th>Nama Dosen</th>
              <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
            <form action="" method='post'>
            <div class="input-field">
                <input placeholder="ID Dosen" type="number" name="id_dosen" class="validate">
            </div>
            </td>
           
            <td>
            <div class="input-field">
                <input placeholder="Nama Dosen" type="text" name="nama_dosen" class="validate">
            </div>
            </td>
            <td>
              <button type="submit" name="submit" value="create_dosen" 
              class="waves-effect waves-light red lighten-2 btn">
                Create
              </button>
            </td>
            </form>
            <td></td>
          </tr>
          <?php
            $sql = "SELECT * FROM Dosen Where is_delete=b'0'";
            $dosen_result = $conn->query($sql);
        
            if ($dosen_result->num_rows > 0) {
              // output data of each row
              while($row = $dosen_result->fetch_assoc()) {
                echo '
               <tr>
                <td>' . $row['NIP'] . '</td>
                <td>' . $row['nama'] . '</td>
                <td>
                  <form action="edit.php" method="post">
                    <input type="hidden" name="nip" value="' . $row['NIP'] . '">
                    <button type="submit" name="edit" value="edit_dosen" 
                    class="waves-effect waves-light btn">
                      Edit
                    </button>
                  </form>
                </td>
                <td>
                <form action="" method="post">
                  <input type="hidden" name="nip" value="' . $row['NIP'] . '">
                  <button type="submit" name="soft_delete" value="soft_delete_dosen" 
                  class="waves-effect waves-light red lighten-2 btn">
                    Delete
                  </button>
                </form>
                </td>
              </tr>';
              
              }
          } else {
            echo "0 results";
          }
        ?>
        </tbody>
      </table>
    </div>
    <div id="test2" class="col s12">
      <table class="striped hightlight">
        <thead>
          <tr>
              <th>Kode MK</th>
              <th>Nama MK</th>
              <th>Action</th>
          </tr>
        </thead>
    
        <tbody>
          <tr>
          <form action="" method='post'>
            <td>
            <div class="input-field">
                <input placeholder="KD Mata Kuliah" type="number" name="kd_mk" class="validate">
            </div>
            </td>
           
            <td>
            <div class="input-field">
                <input placeholder="Nama Mata Kuliah" type="text" name="nama_mk" class="validate">
            </div>
            </td>
            <td>
              <button type="submit" name="submit" value="create_mk" 
              class="waves-effect waves-light red lighten-2 btn">
                Create
              </button>
            </td>
            </form>
            <td></td>
          </tr>
          <?php
            $sql = "SELECT * FROM `Mata Kuliah` Where is_delete=b'0'";
            $mk_result = $conn->query($sql);
        
            if ($mk_result->num_rows > 0) {
              // output data of each row
              while($row = $mk_result->fetch_assoc()) {
                echo '
               <tr>
                <td>' . $row['kd_mk'] . '</td>
                <td>' . $row['nama'] . '</td>
                <td>
                  <form action="edit.php" method="post">
                    <input type="hidden" name="kd_mk" value="' . $row['kd_mk'] . '">
                    <button type="submit" name="edit" value="edit_mk" 
                    class="waves-effect waves-light btn">
                      Edit
                    </button>
                  </form>
                </td>
                <td>
                <form action="" method="post">
                <input type="hidden" name="kd_mk" value="' . $row['kd_mk'] . '">
                <button type="submit" name="soft_delete" value="soft_delete_mk" 
                class="waves-effect waves-light red lighten-2 btn">
                  Delete
                </button>
              </form>
                </td>
              </tr>';
              }
          } else {
            echo "0 results";
          }
        ?>
        </tbody>
      </table>
    </div>
    <div id="test3" class="col s12">
      <table class="striped hightlight">
        <thead>
          <tr>
              <th>Dosen</th>
              <th>Mata Kuliah</th>
              <th>Hari</th>
              <th>Action</th>
          </tr>
        </thead>
    
        <tbody>
          <tr>
            <form action="" method="post" id="jadwal">
            <td>
              <div class="input-field">
              <select name="dosen" form="jadwal">
              <option value="" disabled selected>Pilih Dosen</option>
                <?php
                $sql = "SELECT * FROM Dosen";
                $dosen_result = $conn->query($sql);
                if ($dosen_result->num_rows > 0) {
                  // output data of each row
                  while($row = $dosen_result->fetch_assoc()) {
                    echo '<option value="' . $row['NIP'] . '">' . $row['nama'] . '</option>';
                  }
              }
                 ?>
              </select>
              </div>
            </td>
            <td>
              <div class="input-field">
              <select name="mk" form="jadwal">
                <option value="" disabled selected>Pilih Mata Kuliah</option>
                <?php
                $sql = "SELECT * FROM `Mata Kuliah`";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['kd_mk'] . '">' . $row['nama'] . '</option>';
                  }
              }
                 ?>
              </select>
              </div>
            </td>
            <td>
              <div class="input-field">
              <select name="hari" form="jadwal">
                <option value="" disabled selected>Pilih Hari</option>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Senin">Kamis</option>
                <option value="Selasa">Jumat</option>
                <option value="Rabu">Sabtu</option>
                <option value="Rabu">Minggu</option>
              </select>
              </div>
            </td>
            <td>
            <button type="submit" name="submit" value="create_jadwal" 
              class="waves-effect waves-light red lighten-2 btn">
                Create
            </button>
            </td>
            </form>
            <td></td>
          </tr>
          <?php
            $sql = "SELECT `Mata Kuliah`.nama as mata_kuliah , Dosen.nama as dosen, hari, 
            kd_jadwal, `Jadwal Mengajar`.is_delete, Dosen.NIP as nip, `Mata Kuliah`.kd_mk as kd_mk 
            FROM `Jadwal Mengajar` LEFT JOIN Dosen ON nip_dosen = Dosen.NIP 
            LEFT JOIN `Mata Kuliah` on `Jadwal Mengajar`.kd_mk = `Mata Kuliah`.kd_mk 
            WHERE `Jadwal Mengajar`.`is_delete`=b'0'; 
            ";
            $result = $conn->query($sql);
        
            if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                echo '
               <tr>
                <td>' . $row['dosen'] . '</td>
                <td>' . $row['mata_kuliah'] . '</td>
                <td>' . $row['hari'] . '</td>
                <td>
                  <form action="edit.php" method="post">
                    <input type="hidden" name="kd_jadwal" value="' . $row['kd_jadwal'] . '">
                    <input type="hidden" name="nip" value="' . $row['nip'] . '">
                    <input type="hidden" name="kd_mk" value="' . $row['kd_mk'] . '">
                    <input type="hidden" name="hari" value="' . $row['hari'] . '">
                    <button type="submit" name="edit" value="edit_jadwal" 
                    class="waves-effect waves-light btn">
                      Edit
                    </button>
                  </form>
                </td>
                <td>
                <form action="" method="post">
                <input type="hidden" name="kd_jadwal" value="' . $row['kd_jadwal'] . '">
                <button type="submit" name="soft_delete" value="soft_delete_jadwal" 
                class="waves-effect waves-light red lighten-2 btn">
                  Delete
                </button>
              </form>
                </td>
              </tr>';
              }
          } else {
            echo "0 results";
          }
        ?>
        </tbody>
      </table>
    </div>
  </div>
  <div id="test4" class="col s12">
    <h4>Dosen</h4>
    <table class="striped hightlight">
      <thead>
        <tr>
            <th>NIP</th>
            <th>Nama Dosen</th>
            <th>Action</th>
        </tr>
      </thead>
  
      <tbody>
      <?php
            $sql = "SELECT * FROM Dosen Where is_delete=b'1'";
            $dosen_result = $conn->query($sql);
        
            if ($dosen_result->num_rows > 0) {
              // output data of each row
              while($row = $dosen_result->fetch_assoc()) {
                echo '
               <tr>
                <td>' . $row['NIP'] . '</td>
                <td>' . $row['nama'] . '</td>
                <td>
                  <form action="" method="post">
                    <input type="hidden" name="nip" value="' . $row['NIP'] . '">
                    <button type="submit" name="restore" value="restore_dosen" 
                    class="waves-effect waves-light btn">
                      Restore
                    </button>
                  </form>
                </td>
                <td>
                  <form action="" method="post">
                    <input type="hidden" name="nip" value="' . $row['NIP'] . '">
                    <button type="submit" name="hard_delete" value="hard_delete_dosen" 
                    class="waves-effect waves-light red lighten-2 btn">
                      Delete Permanent
                    </button>
                  </form>
                </td>
              </tr>';
              
              }
          } else {
            echo "0 results";
          }
        ?>
      </tbody>
    </table>

    <h4>Mata Kuliah</h4>
    <table class="striped hightlight">
      <thead>
        <tr>
            <th>Kode MK</th>
            <th>Nama MK</th>
            <th>Action</th>
        </tr>
      </thead>
  
      <tbody>
      <?php
            $sql = "SELECT * FROM `Mata Kuliah` Where is_delete=b'1'";
            $mk_result = $conn->query($sql);
        
            if ($mk_result->num_rows > 0) {
              // output data of each row
              while($row = $mk_result->fetch_assoc()) {
                echo '
               <tr>
                <td>' . $row['kd_mk'] . '</td>
                <td>' . $row['nama'] . '</td>
                <td>
                  <form action="" method="post">
                    <input type="hidden" name="kd_mk" value="' . $row['kd_mk'] . '">
                    <button type="submit" name="restore" value="restore_mk" 
                    class="waves-effect waves-light btn">
                      Restore
                    </button>
                  </form>
                </td>
                <td>
                  <form action="" method="post">
                    <input type="hidden" name="kd_mk" value="' . $row['kd_mk'] . '">
                    <button type="submit" name="hard_delete" value="hard_delete_mk" 
                    class="waves-effect waves-light red lighten-2 btn">
                      Delete Permanent
                    </button>
                  </form>
                </td>
              </tr>';
              }
          } else {
            echo "0 results";
          }
        ?>
      </tbody>
    </table>

    <h4>Jadwal</h4>
    <table class="striped hightlight">
      <thead>
        <tr>
            <th>Kode Jadwal</th>
            <th>Dosen</th>
            <th>Mata Kuliah</th>
            <th>Action</th>
        </tr>
      </thead>
  
      <tbody>
        <tr>
        <?php
            $sql = "SELECT `Mata Kuliah`.nama as mata_kuliah , Dosen.nama as dosen, 
            hari, kd_jadwal, `Jadwal Mengajar`.is_delete 
            FROM `Jadwal Mengajar` LEFT JOIN Dosen ON nip_dosen = Dosen.NIP 
            LEFT JOIN `Mata Kuliah` on `Jadwal Mengajar`.kd_mk = `Mata Kuliah`.kd_mk 
            WHERE `Jadwal Mengajar`.`is_delete`=b'1'; 
            ";
            $result = $conn->query($sql);
        
            if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                echo '
               <tr>
                <td>' . $row['dosen'] . '</td>
                <td>' . $row['mata_kuliah'] . '</td>
                <td>' . $row['hari'] . '</td>
                <td>
                  <form action="" method="post">
                    <input type="hidden" name="kd_jadwal" value="' . $row['kd_jadwal'] . '">
                    <button type="submit" name="restore" value="restore_jadwal" 
                    class="waves-effect waves-light btn">
                      Restore
                    </button>
                  </form>
                </td>
                <td>
                  <form action="" method="post">
                    <input type="hidden" name="kd_jadwal" value="' . $row['kd_jadwal'] . '">
                    <button type="submit" name="hard_delete" value="hard_delete_jadwal" 
                    class="waves-effect waves-light red lighten-2 btn">
                      Delete Permanent
                    </button>
                  </form>
                </td>
              </tr>';
              }
          } else {
            echo "0 results";
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
  let tab = document.getElementById('tab')
  M.Tabs.init(tab, {})

  let selects = document.querySelectorAll('select');
  M.FormSelect.init(selects, {});
</script>
</html>