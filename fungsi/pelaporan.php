<?php
if(!isset($_SESSION)){
    session_start();
}
    /*MAHASISWA*/
    function tampildatahonor($connect){
/*        require '../../koneksi.php';*/

        $sql = "
                            SELECT kode_tutor, nama,  count(*) as jaga FROM absensi
JOIN tutor using (kode_tutor)
JOIN detil_user using (nim)
where admin_acc is not null
group by kode_tutor";

        $mahasiswa = mysqli_query($connect, $sql);
        if(mysqli_num_rows($mahasiswa) > 0){
            foreach ($mahasiswa as $value) {
                $jaga = $value['jaga'];
                if ($jaga > intval(10)){
                    $totalhonor = (25000*$jaga) + 150000;
                }
                else
                {
                    $totalhonor = 25000*$jaga;
                }
                
// Melakukan seleksi dari database Presensi dan join dengan
// database Tentor
// - Melakukan penghitungan kedatangan tentor
// - Jika tentor datang ≥ 10x maka gaji tentor = jumlah
// kedatangan * 25000 + 150000
// - Jika tentor datang &lt; 10x maka gaji tentor = jumlah
// kedatangan * 25000
// - Menampilkan gaji tentor
                echo "
                                    <tr>
                                        <td>".$value['kode_tutor']."</td>
                                        <td>".$value['nama']."</td>
                                        <td>".$value['jaga']."</td>
                                        <td>Rp ".$totalhonor.",00</td>
                                        </tr>
                                    ";
            }
        }

    }
?>