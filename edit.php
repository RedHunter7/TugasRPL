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

  <?php
$servername = "localhost";
$username = "username";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['edit'])) {
    if ($_POST['edit'] == "edit_dosen") {
      $sql = "SELECT * FROM Dosen Where NIP=" . $_POST['nip'];
      $dosen = $conn->query($sql); 
      $row = $dosen->fetch_assoc();
      ?>
    <form action="admin.php" method="post">
      <input type="hidden" name="nip" value="<? echo $row['NIP']; ?>">
      <div class="input-field">
        <input value="<?echo $row['nama'];?>" name="nama_dosen" id="nama_dosen" type="text" class="validate">
        <label for="nama_dosen">Nama Dosen</label>
      </div>
      <button type="submit" name="edit" value="edit_dosen" 
      class="waves-effect waves-light btn">
        Submit
      </button>
    </form> <?php
    }
    elseif ($_POST['edit'] == "edit_mk") {
      $sql = "SELECT * FROM `Mata Kuliah` Where kd_mk=" . $_POST['kd_mk'];
      $mk = $conn->query($sql); 
      $row = $mk->fetch_assoc(); 
      ?>
      <form action="admin.php" method="post">
      <input type="hidden" name="kd_mk" value="<? echo $row['kd_mk']; ?>">
      <div class="input-field">
        <input value="<? echo $row['nama']; ?>" name="nama_mk" id="nama_mk" type="text" class="validate">
        <label for="nama_mk">Nama Mata Kuliah</label>
      </div>
      <button type="submit" name="edit" value="edit_mk" 
      class="waves-effect waves-light btn">
        Submit
      </button>
    </form> <?php    
    }
    elseif ($_POST['edit'] == "edit_jadwal") { ?>
    <form action="admin.php" method="post" id="jadwal">
      <input type="hidden" name="kd_jadwal" value="<? echo $_POST['kd_jadwal']; ?>">
      <div class="row"> 
        <div class="input-field col s4">
          <select name="dosen" form="jadwal">
            <?php
                $sql = "SELECT * FROM Dosen";
                $dosen_result = $conn->query($sql);
                if ($dosen_result->num_rows > 0) {
                  // output data of each row
                  while($row = $dosen_result->fetch_assoc()) {
                    if ($row['NIP'] == $_POST['nip']) {
                      echo '<option value="' . $row['NIP'] . '" selected>' . $row['nama'] . '</option>';
                    } else {
                      echo '<option value="' . $row['NIP'] . '">' . $row['nama'] . '</option>';
                    }
                  }
              }
              ?>
          </select>
        </div>
        <div class="input-field col s4">
          <select name="mk" form="jadwal">
            <?php
                $sql = "SELECT * FROM `Mata Kuliah`";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                    if ($row['kd_mk'] == $_POST['kd_mk']) {
                      echo '<option value="' . $row['kd_mk'] . '" selected>' . $row['nama'] . '</option>';
                    } else {
                      echo '<option value="' . $row['kd_mk'] . '">' . $row['nama'] . '</option>';
                    }
                  }
              }
                 ?>
          </select>
        </div>
        <div class="input-field col s4">
          <select name="hari" form="jadwal">
            <option value="<? echo $_POST['hari'];?>" selected><? echo $_POST['hari'];?></option>
            <option value="Senin">Senin</option>
            <option value="Selasa">Selasa</option>
            <option value="Rabu">Rabu</option>
            <option value="Kamis">Kamis</option>
            <option value="Jumat">Jumat</option>
            <option value="Sabtu">Sabtu</option>
            <option value="Minggu">Minggu</option>
          </select>
        </div>
      </div>
      <button type="submit" name="edit" value="edit_jadwal" 
      class="waves-effect waves-light btn">
        Submit
      </button>
    </form> <?php    
    }
  }
} 
?>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
  var elems = document.querySelectorAll('select');
  var instances = M.FormSelect.init(elems, {});
</script>
</html>