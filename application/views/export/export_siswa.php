<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=data_siswa".date('Y-m-d').".xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>

 <table>
            <tr>
        <th>No</th>
        <th>NIS</th>
        <th>Nama Siswa</th>
        <th>Alamat</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
        <th>No Hp</th>
        <th>Email</th>
        <th>Kelas</th>
        <th>Jurusan</th>
        <th>ID Foto</th>
        <th>Tanggal Pembuatan Akun</th>
            </tr><?php
            $siswa_data = $this->db->get('user');
            $start = 0;
            foreach ($siswa_data->result() as $siswa)
            {
                ?>
                <tr>
            <td><?php echo ++$start ?></td>
            <td><?php echo $siswa->nis ?></td>
            <td><?php echo $siswa->nama_siswa ?></td>
            <td><?php echo $siswa->alamat ?></td>
            <td><?php echo $siswa->tempat_lahir ?></td>
            <td><?php echo $siswa->tanggal_lahir ?></td>
            <td><?php echo $siswa->no_hp ?></td>
            <td><?php echo $siswa->email ?></td>
            <td><?php echo $siswa->kelas ?></td>
            <td><?php echo $siswa->jurusan ?></td>
            <td><?php echo $siswa->foto ?></td>            
            <td><?php echo $siswa->tanggal_pembuatan ?></td>
        </tr>
                <?php
            }
            ?>
        </table>