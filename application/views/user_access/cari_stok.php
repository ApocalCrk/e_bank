<div class="row col" style="margin-bottom: 10px;left: 10px">
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('Siswaui/cari_barang'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="Siswaui/cari_barang" class="btn btn-secondary" style="border-radius: 0;">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit" style="border-radius: 0;margin-left: -4px">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive col">
        <table class="table table-bordered" id="example1" style="margin-bottom: 10px;font-size: 14px;">
            <thead>
            <tr>
                <th>No</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($barang_data as $barang)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $barang->kode_barang ?></td>
            <td><?php echo $barang->nama_barang ?></td>
            <td><?php echo $barang->stok ?></td>
        </tr>
    </tbody>
                <?php
            }
            ?>
        </table>
    </div>
        <div class="row col">
            <div class="col-md-6">
                <div class="btn btn-primary">Total Record : <?php echo $total_rows ?></div>
            </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
<script>
  $(function () {
    $('#example1').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": false,
      
    });
  });
</script>