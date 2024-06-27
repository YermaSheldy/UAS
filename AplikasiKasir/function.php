<?php
session_start();

$koneksi = mysqli_connect('localhost','root','','kasir');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $check = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='password'")
    $hitung = mysqli_num_rows($check);

    if ($hitung > 0) {
        $_SESSION['login'] = true;
        header('location:index.php');
    } else {
        echo'
        <script>
        alert("username atau password salah")
        window.location.href="login.php"
        </script>';
    }
}
if (isset($_POST['tambahproduk'])){
    
    55$nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stock = $_POST['stock'];

    $insert_produk = mysqli_query($koneksi,"INSERT INTO produk (nama_produk, deskripsi, harga, stock)
    VALUES ('$nama_produk', '$deskripsi', '$harga', '$stock')");

    if ($insert_produk) {
        header('location:stock.php');
    }else{
        echo '
        <script>
        alert("gagal tambah produk")
        window.location.href="stock.php"
        </script>';
    }
}
if (isset($_POST['tambahpelanggan'])){
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $notelp = $_POST['notelp'];
    $alamat = $_POST['alamat'];

    $insert_pelanggan = mysqli_query($koneksi,"INSERT INTO pelanggan (nama_pelanggan, notelp, alamat)
    VALUES ('$nama_pelanggan', '$notelp', '$alamat')");

    if ($insert_pelanggan) {
        header('location:pelanggan.php');
    } else {
        echo '
        <script>
        alert("gagal tambah pelanggan")
        window.location.href="pelanggan.php"
        </script>';
    }
}
if (isset($_POST['tambahpesanan'])){
    $id_pelanggan = $_POST['id_pesanan'];
    
    $insert_pesanan = mysqli_query($koneksi,"INSERT INTO pesanan (id_pelanggan)
    VALUES ('$id_pelanggan')");

    if ($insert_pelanggan) {
        header('location:index.php');
    } else {
        echo '
        <script>
        alert("gagal tambah pelanggan")
        window.location.href="index.php"
        </script>';
    }
}
if (isset($_POST['addproduk'])){
    $id_produk = $_POST['id_produk'];
    $idp = $_POST['idp'];
    $qty = $_POST['qty'];
    
    $hitung1 = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id_produk'");
    $hitung2 = mysqli_fetch_array($hitung1);
    $stocksekarang = $hitung2['stock'];

    if($stocksekarang>=$qty){

        $selisih = $stocksekarang - $qty;

        $insert = mysqli_query($koneksi, "INSERT INTO detail_pesanan (id_pesanan, id_produk, qty) 
        VALUES ('$idp', '$id_produk', '$qty')");
        $update = mysqli_query($koneksi, "UPDATE produk SET stock='$selisih' WHERE id_produk='$id_produk'")

    if ($insert && $update) {
        header('location:view.php?idp='. $idp);
    } else {
        echo '
        <script>
        alert("gagal tambah pelanggan")
        window.location.href="view.php' . $idp .'"
        </script>';
    }
} else 
    echo '
        <script>
        alert("stock tidak cukup")
        window.location.href="view.php' . $idp .'"
        </script>';
}
if(isset($_POST['barangmasuk'])){
    $id_produk = $_POST['id_produk'];
    $qty = $_POST['qty'];

    $insertbar = mysqli_query($koneksi, "INSERT INTO masuk (id_produk, qty)
    VALUES ('$id_produk', '$qty')")

    if($insertbar){
        header('location:masuk.php');
    } else {
        echo '
        <script>
        alert("gagal")
        window.location.href="masuk.php"
        </script>';
    }
}
if(isset($_POST['hapusprodukpesanan'])) {
    $iddetail = $_POST['iddetail'];
    $idpr = $_POST['idpr'];
    $idp = $_POST['idp'];

    $cek1 = mysqli_query($koneksi, "SELECT * FROM detail_pesanan WHERE id_detailpesanan='$iddetail'");
    $cek2 = mysqli_fetch_array($cek1);
    $qtysekarang = $cek2['qty'];

    $cek3 = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$idpr'");
    $cek4 = mysqli_fetch_array($cek3);
    $stocksekarang = $cek4['stock'];

    $hitung = $stoksekarang+$qtysekarang

    $update = mysqli_query($koneksi, "UPDATE produk SET stock='$hitung' WHERE id_produk='$idpr'");
    $hapus = mysqli_query($koneksi, "DELETE from detail_pesanan WHERE id_produk='$idpr' AND id_detailpesanan='$iddetail'");

    if ($update && $hapus) {
        header('location:view.php?=' . $idp);
    } else {
        echo '
        <script>
        alert("stock tidak cukup")
        window.location.href="view.php' . $idp .'"
        </script>';
    }
}

if (isset($_POST['editproduk'])) {
    $np = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $idpr = $_POST['id_produk'];

    $edit_barang = mysqli_query($koneksi,"UPDATE produk SET nama_produk='$np', deskripsi='$deskripsi', harga='$harga' WHERE id_produk='$idpr'");

    if($edit_barang) {
        header('location:stock.php');
    }else{
        echo '
        <script>
        alert("gagal edit barang")
        window.location.href="stock.php"
        </script>';
    }
}

if (isset($_POST['hapusproduk'])) {
    $idpr = $_POST['id_produk'];

    $hapusbarang = mysqli_query($koneksi,"DELETE FROM produk WHERE id_produk='$idpr'");

    if($hapusbarang) {
        header('location:stock.php');
    }else{
        echo '
        <script>
        alert("gagal hapus barang")
        window.location.href="stock.php"
        </script>';
    }
}
