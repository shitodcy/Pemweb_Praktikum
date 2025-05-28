<?php
      //praktikum 1
     echo "<h1>Welcome to PHP TES</h1>";
     echo "<p>This is a simple PHP test page.</p>";

     //check web browser user agent
     $user_agent = $_SERVER['HTTP_USER_AGENT'];
     echo "<p>Your user agent is: $user_agent</p>";

?>
<?php
if (str_contains($_SERVER['HTTP_USER_AGENT'], 'Chrome')) {
?>
<h3>str_contains() returned true</h3>
<p>You are using Chrome</p>
<?php
} else {
?>
<h3>str_contains() returned false</h3>
<p>You are not using Firefox</p>
<?php
}
?>
<hr>
<hr>
<?php
//make example variabel and echo   
$nama = "John Doe";
$umur = 30;
$tinggi = 175.5;
echo "<p>Nama: $nama</p>"
        . "<p>Umur: $umur</p>"
        . "<p>Tinggi: $tinggi cm</p>";              
//make example array and echo       
echo "<hr>";

//make oen varibel text 
$teks = "Hello, World!";

echo "<p>Text: $teks</p>";
echo strlen($teks) . " karakter<br>";
echo str_word_count($teks) . " kata<br>";
echo "Huruf pertama: " . $teks[0] . "<br>"; 
echo strpos($teks, "World") . "<br>";
echo str_replace("World", "PHP", $teks) . "<br>";
echo strrev($teks) . "<br>";

//make example String Concatenation
echo "<hr>";
$namaDepan = "Fufufufu";        
$namaBelakang = "Fafafaf";
$namaLengkap = $namaDepan . " " . $namaBelakang;
echo "<p>Nama Lengkap: $namaLengkap</p>";

//make example Escape Character 
echo "<hr>";
$teks = "Hello, \"World\"!";            
echo "<p>Text dengan Escape Character: $teks</p>";
//make example String Interpolation
echo "<hr>";        
$nama = "Fufufufu";
$umur = 30;     
echo "<p>Nama: $nama, Umur: $umur</p>";
//make an example type of PHP Numbers
echo "<hr>";    
$angka = 10;
$desimal = 3.14;
echo "<p>Angka: $angka, Desimal: $desimal</p>";

//make a example of PHP Casting
$angkaString = "123";
$angkaInt = (int) $angkaString;
echo "<p>Angka String: $angkaString, Angka Int: $angkaInt</p>"; 

//make examle of Php arithmetic operators
$angka1 = 10;       
$angka2 = 5;
$jumlah = $angka1 + $angka2;
$selisih = $angka1 - $angka2;
$kali = $angka1 * $angka2;
$bagian = $angka1 / $angka2;
echo "<p>Jumlah: $jumlah, Selisih: $selisih, Kali: $kali, Bagian: $bagian</p>";
?>
