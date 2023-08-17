<?php
session_start();
include "../config.php";   //memasukan koneksi
if (empty($_SESSION['username'])) {
    header("location:../index.php");
}

include "fungsi_LSB.php"; //memasukan LSB

if (isset($_POST['enkripsi_now'])) {
    
    $user           = $_SESSION['username'];
    // $key            = $mysqli->real_escape_string(substr(md5($_POST["pwdfile"]), 0, 16));
    $pesan          = $_POST['pesan'];
    $gambar         = $_FILES['gambar']['tmp_name'];
    $ukuran_gambar  = filesize($gambar);
    $nama_gambar    = $_FILES['gambar']['name'];

    $pesan .='|'; //EOF sign, decided to use the pipe symbol to show our decrypter the end of the message
    $pesanBin = toBin($pesan); //Convert our message to binary
    $pesanLength = strlen($pesanBin); //Get message length
    $img = imagecreatefromjpeg($gambar); //returns an image identifier
    list($width, $height, $type, $attr) = getimagesize($gambar); //get image size

    if($pesanLength>($width*$height)){ //The image has more bits than there are pixels in our image
    echo('Message too long. This is not supported as of now.');
    die();
    }

    $pixelX=0; //Coordinates of our pixel that we want to edit
    $pixelY=0; //^

    for($x=0;$x<$pesanLength;$x++){ //Encrypt message bit by bit (literally)

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

    $newR = $r; //we dont change the red or green color, only the lsb of blue
    $newG = $g; //^
    $newB = toBin($b); //Convert our blue to binary
    $newB[strlen($newB)-1] = $pesanBin[$x]; //Change least significant bit with the bit from out message
    $newB = toString($newB); //Convert our blue back to an integer value (even though its called tostring its actually toHex)

    $new_color = imagecolorallocate($img,$newR,$newG,$newB); //swap pixel with new pixel that has its blue lsb changed (looks the same)
    imagesetpixel($img,$pixelX,$pixelY,$new_color); //Set the color at the x and y positions
    $pixelX++; //next pixel (horizontally)

    }
    $randomDigit = rand(1,9999); //Random digit for our filename
    // imagepng($img,'result' . $randomDigit . '.png'); //Create image
    // echo('done: ' . 'result' . $randomDigit . '.png'); //Echo our image file name
    $letak_file_enkripsi = imagepng($img,'file_enkripsi/enkripsi' . $randomDigit . '.png'); 
    $letak_file_enkripsi = 'file_enkripsi/enkripsi' . $randomDigit . '.png';
    $nama_file_enkripsi = 'enkripsi' . $randomDigit . '.png';
    
    $sql1   = "INSERT INTO enkripsi VALUES ('', '$user', '$nama_gambar', '$nama_file_enkripsi' ,'$letak_file_enkripsi', '$ukuran_gambar', now())";
    $query1  = $mysqli->query($sql1) or die(mysqli_error($mysqli));

    if ($query1) {
        $message = "Data Berhasil di Enkripsi";
        echo "<script type='text/javascript'>
        window.alert('$message');
        window.location.href='enkripsi.php';</script>";
    }

    

}

?>