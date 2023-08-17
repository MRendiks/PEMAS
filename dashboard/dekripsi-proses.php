<?php
session_start();
include "../config.php";   //memasukan koneksi
include "fungsi_LSB.php"; //memasukan file LSB

if (isset($_POST['dekripsi_now'])) {
    $id_enkripsi = $_POST['id_enkripsi'];
    $query = $mysqli->query("SELECT * FROM enkripsi WHERE id_enkripsi='$id_enkripsi'");
    $data3 = mysqli_fetch_array($query);
    $gambar = $data3['letak_file_enkripsi'];
    $nama_gambar = $data3['nama_file'];
    $ukuran_gambar  = filesize($gambar);

    
    $img = imagecreatefrompng($gambar); //Returns image identifier
    $real_message = ''; //Empty variable to store our message

    $count = 0; //Wil be used to check our last char
    $pixelX = 0; //Start pixel x coordinates
    $pixelY = 0; //start pixel y coordinates

    list($width, $height, $type, $attr) = getimagesize($gambar); //get image size

    for ($x = 0; $x < ($width*$height); $x++) { //Loop through pixel by pixel
    if($pixelX === $width+1){ //If this is true, we've reached the end of the row of pixels, start on next row
        $pixelY++;
        $pixelX=0;
    }

    if($pixelY===$height && $pixelX===$width){ //Check if we reached the end of our file
        echo('Max Reached');
        die();
    }

    $rgb = imagecolorat($img,$pixelX,$pixelY); //Color of the pixel at the x and y positions
    $r = ($rgb >>16) & 0xFF; //returns red value for example int(119)
    $g = ($rgb >>8) & 0xFF; //^^ but green
    $b = $rgb & 0xFF;//^^ but blue

    $blue = toBin($b); //Convert our blue to binary

    $real_message .= $blue[strlen($blue) - 1]; //Ad the lsb to our binary result

    $count++; //Coun that a digit was added

    if ($count == 8) { //Every time we hit 8 new digits, check the value
        if (toString(substr($real_message, -8)) === '|') { //Whats the value of the last 8 digits?
            // echo ('done<br>'); //Yes we're done now
            $real_message = toString(substr($real_message,0,-8)); //convert to string and remove /
            // echo ('Result: ');
            // echo $real_message; //Show
            imagepng($nama_gambar,'file_dekripsi/dekripsi' . $randomDigit . '.png'); 
            $sql2   = "INSERT INTO dekripsi VALUES ('', '$nama_gambar', '$ukuran_gambar', '$real_message')";
            $query1  = $mysqli->query($sql2) or die(mysqli_error($mysqli));
        
            if ($query1) {
                $message = "Data Berhasil di Enkripsi";
                echo "<script type='text/javascript'>alert('$message');</script>";
                header("location:data_pengaduan.php");
            }
        }
        $count = 0; //Reset counter
    }

    $pixelX++; //Change x coordinates to next
    }
}

// $idfile    = $mysqli->real_escape_string($_POST['fileid']);
// $pwdfile   = $mysqli->real_escape_string(substr(md5($_POST["pwdfile"]), 0, 16));
// $query     = "SELECT password FROM file WHERE id_file='$idfile' AND password='$pwdfile'";
// $sql       = $mysqli->query($query);
// if (mysqli_num_rows($sql) > 0) {
//     $query1     = "SELECT * FROM file WHERE id_file='$idfile'";
//     $sql1       = $mysqli->query($query1);
//     $data       = mysqli_fetch_assoc($sql1);

//     $file_path  = $data["file_url"];
//     $key        = $data["password"];
//     $file_name  = $data["file_name_source"];
//     $size       = $data["file_size"];

//     $file_size  = filesize($file_path);

//     $query2     = "UPDATE file SET status='2' WHERE id_file='$idfile'";
//     $sql2       = $mysqli->query($query2);

//     $mod        = $file_size % 16;

//     $aes        = new AES($key);
//     $fopen1     = fopen($file_path, "rb");
//     $plain      = "";
//     $cache      = "file_dekripsi/$file_name";
//     $fopen2     = fopen($cache, "wb");

//     if ($mod == 0) {
//         $banyak = $file_size / 16;
//     } else {
//         $banyak = ($file_size - $mod) / 16;
//         $banyak = $banyak + 1;
//     }

//     ini_set('max_execution_time', -1);
//     ini_set('memory_limit', -1);
//     for ($bawah = 0; $bawah < $banyak; $bawah++) {

//         $filedata    = fread($fopen1, 16);
//         $plain       = $aes->dekripsi($filedata);
//         fwrite($fopen2, $plain);
//     }

//     echo ("<script language='javascript'>
//        window.open('download.php', '_blank');
//        window.location.href='file.php';
//        window.alert('Berhasil mendekripsi file.');
//        </script>
//        ");
// } else {
//     echo ("<script language='javascript'>
//     window.location.href='dekripsi-file.php?id_file=$idfile';
//     window.alert('Maaf, Password tidak sesuai.');
//     </script>");
// }
