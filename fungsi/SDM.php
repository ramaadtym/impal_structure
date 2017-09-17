<?php


function tampildatatutor($connect){
    $sql = "SELECT * FROM user u JOIN detil_user d ON (u.nim = d.nim)  JOIN tutor t ON (u.nim = t.nim) WHERE (u.user_level='Tutor')";
    $tutor = mysqli_query($connect, $sql);
    if(mysqli_num_rows($tutor) > 0){
        foreach ($tutor as $value) {
            echo "
                                    <tr>
                                        <td>".$value['kode_tutor']."</td>                                        
                                        <td>".$value['nim']."</td>
                                        <td>".$value['nama']."</td>
                                        <td>".$value['matkul1']."</td>
                                        <td>".$value['matkul2']."</td>
                                        <td>
                                            <a href='edit.php?nim=$value[nim]'>
                                                <button type=\"button\" class=\"btn btn-primary waves-effect\">
                                                    <i class=\"material-icons\">edit</i>
                                                </button>
                                            </a>
                                        </td>   
                                    </tr>
                                    ";
        }
    }
}
function detiltutor($connect){

    require '../../koneksi.php';

    if (!isset($_GET['nim'])) {
        echo '<script>alert("NIM Tidak Sesuai");window.location.href=\'../tutor\';</script>';
    } else {
        $search = $_GET['nim'];
        $sql = "SELECT *
                FROM user u
                JOIN detil_user d ON (u.nim = d.nim)
                JOIN tutor t ON (u.nim = t.nim)
                WHERE (u.user_level='Tutor') AND (u.nim='$search')";
        $query = mysqli_query($connect, $sql);
        if (mysqli_num_rows($query) == 0) {
            echo '<script>alert("NIM Tidak Sesuai");window.location.href=\'../tutor\';</script>';

        }
        $tutor = mysqli_fetch_array($query);
    }
}
