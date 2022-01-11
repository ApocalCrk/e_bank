<table class="table">
        <tr><td>Nis</td><td><?php echo $nis; ?></td></tr>
        <tr><td>Nama</td><td><?php echo $nama_siswa; ?></td></tr>
        <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
        <tr><td>Tempat Lahir</td><td><?php echo $tempat_lahir; ?></td></tr>
        <tr><td>Tanggal Lahir</td><td><?php echo $tanggal_lahir; ?></td></tr>
        <tr><td>No Hp</td><td><?php echo $no_hp; ?></td></tr>
        <tr><td>Email</td><td><?php echo $email; ?></td></tr>
        <tr><td>Kelas</td><td><?php echo $kelas; ?></td></tr>
        <tr><td>Foto</td><td><img src="image/siswa/<?php echo $foto; ?>" width="100px"></td></tr>
        <tr><td>Jurusan</td><td><?php echo $jurusan; ?></td></tr>

        <tr><td></td><td><a href="<?php echo site_url('siswa') ?>" class="btn btn-default">Cancel</a></td></tr>
    </table>