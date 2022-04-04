<?php
    // Koneksi Databse
    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "fathony";

    $koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));
    // Jika tombol simpan 
    if(isset($_POST['bsimpan'])) {
      //Pengujian apakah data akan diedit atau disimpan baru
        if($_GET['hal'] == "edit") {
          // data yang akan di edit
          $edit = mysqli_query($koneksi, "UPDATE fath_073 set
                                          Nama    = '$_POST[tnama]',
                                          NIA     = '$_POST[tnia]',
                                          Alamat  = '$_POST[talamat]',
                                          KC      = '$_POST[tkc]'
                                          WHERE Id_Mhs = '$_GET[id]'
          
          ");
          if ($edit) {  //jika edit sukses
              echo    "<script>
                          alert('edit data Sukses!');
                          document.location='crud1.php';
                      </script>";
          }else {
              echo    "<script>
                          alert('edit data gagal!');
                          document.location='crud1.php';
                      </script>"; 
          }
        }else {
          $simpan = mysqli_query($koneksi,    "INSERT INTO fath_073 (Nama, Nia, Alamat, KC)
                                              VALUES  ('$_POST[tnama]',
                                                      '$_POST[tnia]', 
                                                      '$_POST[talamat]',
                                                      '$_POST[tkc]')
                                                          ");
          if ($simpan) {
              echo    "<script>
                          alert('Simpan data Sukses!');
                          document.location='crud1.php';
                      </script>";
          }else {
              echo    "<script>
                          alert('Simpan data gagal!');
                          document.location='crud1.php';
                      </script>"; 
          }
      }

        }
    // Pengujian diedit dan hapus
    if(isset($_GET['hal'])) {
      // tampilkan data yang diedit
      if($_GET['hal'] == "edit") {
        $tampil = mysqli_query($koneksi, "SELECT * FROM fath_073 WHERE Id_Mhs = '$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if($data) {
          // ifdata ditemukan maka ditampung kedalam data
          $vnama    = $data['Nama'];
          $vnia     = $data ['NIA'];
          $valamat  = $data ['Alamat'];
          $vkc      = $data ['KC'];
          // dari tabel yang Nama, NIA, Alamat, KC
        }
      } else if($_GET['hal'] == "hapus") {
          $hapus = mysqli_query($koneksi, "DELETE FROM fath_073 Where Id_Mhs='$_GET[id]'");
          if($hapus){
            echo    "<script>
                          alert('Hapus data Sukses!');
                          document.location='crud1.php';
                      </script>";
          }
      }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title>Hello, world!</title>

  </head>
  <body>
    <div class="jumbotron jumbotron-fluid bg-info text-white">
        <div class="container">
          <h1 class="display-4" style="font-weight:bold;">Hallo !!!, Selamat Datang</h1>
          <p class="lead">Halaman ini adalah halaman untuk admin</p>
        </div>
    </div>
    <!-- Ini awal card -->
    <div class="container">
        <div class="card" style="margin-top:30px;">
          <div class="card-header bg-warning text-white"><h2>Form Mahaiswa</h2></div>
          <div class="card-body">
            <h5 class="mb-4">Isi data dibawah ini dengan benar untuk menambahkan data mahasiswa</h5>
            <form action="#" method="post">
                    <div class="form-group">
                        <label for="disabledTextInput">Nama</label>
                        <input type="text" name="tnama" value="<?=@$vnama?>" class="form-control" placeholder="Inputkan Nama Mahasiswa" required>
                    </div>
                    <div class="form-group">
                        <label for="disabledTextInput">Nia</label>
                        <input type="text" name="tnia" value="<?=@$vnia?>" class="form-control" placeholder="Inputkan Nim Mahasiswa" required>
                    </div>
                    <div class="form-group">
                        <label for="disabledTextInput">Alamat</label>
                        <textarea name="talamat" class="form-control" placeholder="Inputkan Alamat Mahasiswa" cols="30" rows="5" required><?=@$valamat?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="disabledTextInput" >Kelas Creative</label>
                        <select name="tkc" class="form-control" required>
                            <option value="<?=@$vkc?>"></option>
                            <option value="kcweb">Website</option>
                            <option value="kcdesain">Desain</option>
                            <option value="kcfotografi">Fotografi</option>
                            <option value="kcgame">Game</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="bsimpan">Submit</button>
                    <button type="reset" class="btn btn-danger" name="breset">Reset</button>
            </form>
          </div>
        </div>
        <!-- awal tabel -->
        <div class="card" style="margin-top:30px;">
          <div class="card-header bg-primary text-white"><h2>Form Mahaiswa</h2></div>
          <div class="card-body">
            <h5 class="mb-4">Daftar Mahasiswa yang telah berhasil ditambahkan</h5>
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Nia</th>
                  <th scope="col">Alamat</th>
                  <th scope="col">Kelas Creative</th>
                  <th scope="col">Aksi</th>
                </tr>
              <?php 
                    $no = 1;
                    $tampil = mysqli_query($koneksi, "SELECT * from fath_073 order by Id_Mhs desc");
                    while($data = mysqli_fetch_array($tampil)) :
              ?>
              </thead>
              
              <tbody>
                <tr>
                  <th scope="row"><?=$no++;?></th>
                  <td><?=$data['Nama'];?></td>
                  <td><?=$data['NIA'];?></td>
                  <td><?=$data['Alamat'];?></td>
                  <td><?=$data['KC'];?></td>
                  <td>
                      <a class="btn btn-warning" href="crud1.php?hal=edit&id=<?=$data['Id_Mhs']?>" role="button">Edit</a>
                      <a class="btn btn-danger" href="crud1.php?hal=hapus&id=<?=$data['Id_Mhs']?>" role="button" onclick="return confirm('Apakah anda yakin untuk menghapus data ini ?')">Hapus</a>
                  </td>
                </tr>
              </tbody>
              <?php endwhile;?>
          </table>
          </div>

        </div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
  </body>
</html>