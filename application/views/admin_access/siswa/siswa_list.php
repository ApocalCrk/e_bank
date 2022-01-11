<div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('siswa/create'),'Tambah Siswa', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('siswa/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('siswa'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered" id="example1" style="margin-bottom: 10px">
            <thead>
            <tr>
                <th>No</th>
        <th>NIS</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
        <th>No Hp</th>
        <th>Kelas</th>
        <th>Foto</th>
        <th>Jurusan</th>
        <th>Action</th>
            </tr></thead>
            <tbody><?php
            foreach ($siswa_data as $siswa)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $siswa->nis ?></td>
            <td><?php echo $siswa->nama_siswa ?></td>
            <td><?php echo $siswa->alamat ?></td>
            <td><?php echo $siswa->tempat_lahir ?></td>
            <td><?php echo $siswa->tanggal_lahir ?></td>
            <td><?php echo $siswa->no_hp ?></td>
            <td><?php echo $siswa->kelas ?></td>
            <td><img src="image/siswa/<?php echo $siswa->foto ?>" style="width: 50px; height: 50px;"></td>
            <td><?php echo $siswa->jurusan ?></td>
            <td style="text-align:center" width="200px">
                <?php 
                echo anchor(site_url('siswa/read/'.$siswa->id_siswa),'Detail'); 
                echo ' | '; 
                echo anchor(site_url('siswa/update/'.$siswa->id_siswa),'Update'); 
                echo ' | '; 
                echo anchor(site_url('siswa/delete/'.$siswa->id_siswa),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                ?>
            </td>
        </tr>
                <?php
            }
            ?>
        </tbody>
        </table>
    </div>
        <div class="row">
            <div class="col-md-6">
                <div class="btn btn-primary">Total Record : <?php echo $total_rows ?></div>
                <!-- Trigger the modal with a button -->
                <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Import</button> -->
                <a href="app/export_siswa" target="_blank" class="btn btn-info">Export</a>
        </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form action="siswa/upload" method="POST" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Import Data</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>Upload</label>
            <input type="file" class="form-control" name="file" id="file"/>
        </div>
        
      </div>
      <div class="modal-footer">
        <button class="btn btn-info" type="submit">Simpan</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    </form>

  </div>
</div>