<?php
$servername = "localhost";
$username = "username";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

session_start();
   
$user_check = $_SESSION['login_user'];

$ses_sql = mysqli_query($conn, "select username from User where username = '$user_check' ");
   
$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
$login_session = $row['username'];
   
if(!isset($_SESSION['login_user'])) {
  header("location:index.php");
  die();
}

$search_value = "";

if($_SERVER["REQUEST_METHOD"] == "GET") {
  if (isset($_GET['search'])) {
    if($_GET['search'] == "") $search_value = "";
    else $search_value = $_GET['search'];
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
    <form action="" method="get">
      <div class="input-field col s10">
        <input id="search_text" name="search" type="text" class="validate">
        <label for="search_text">Cari Sesuatu</label>
      </div>
      <div class="col s1 valign-wrapper">
        <button class="btn waves-effect waves-light" type="submit">Search</button>
      </div>
    </form>
    
    <form action="" method="get">
      <div class="col s1 valign-wrapper">
        <input type="hidden" name="search" value="">
        <button class="btn waves-effect waves-light" type="submit">Reset</button>
      </div>
    </form>
</div>

  <table class="striped hightlight">
        <thead>
          <tr>
              <th>Dosen</th>
              <th>Mata Kuliah</th>
              <th>Hari</th>
          </tr>
        </thead>
    
        <tbody>
          <?php
            $sql = "SELECT `Mata Kuliah`.nama as mata_kuliah , Dosen.nama as dosen, hari, 
            kd_jadwal, `Jadwal Mengajar`.is_delete, Dosen.NIP as nip, `Mata Kuliah`.kd_mk as kd_mk 
            FROM `Jadwal Mengajar` LEFT JOIN Dosen ON nip_dosen = Dosen.NIP 
            LEFT JOIN `Mata Kuliah` on `Jadwal Mengajar`.kd_mk = `Mata Kuliah`.kd_mk 
            WHERE `Jadwal Mengajar`.`is_delete`=b'0' 
            and (`Mata Kuliah`.nama LIKE '" . $search_value . "%' 
            or Dosen.nama LIKE '" . $search_value . "%' 
            or hari LIKE '" . $search_value . "%'); 
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
              </tr>';
              }
          } else {
            echo "0 results";
          }
        ?>
        </tbody>
      </table>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
  let tab = document.getElementById('tab')
  M.Tabs.init(tab, {})

  let selects = document.querySelectorAll('select');
  M.FormSelect.init(selects, {});
</script>
</html>