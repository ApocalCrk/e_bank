<div class="col-md-4" style="margin-bottom: 10px;">
            <?php echo anchor(site_url('barang/create'),'Create', 'class="btn btn-primary"'); ?>
        </div>
<table class="table table-bordered" style="margin-bottom: 10px">
        
            <tr>
                <th>No</th>
        <th>Kode Barang</th>
        <th>Nama Suplayer</th>
        <th>Nama Barang</th>
        <th>Stok</th>
        <th>Harga Jual</th>
        <th>Laba</th>
        <th>Action</th>
        
            </tr><?php
            $start=0;
            $barang_data = $this->db->get_where('barang');
            foreach ($barang_data->result() as $barang)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start; ?></td>
            <td><?php echo $barang->kode_barang ?></td>
            <td><?php echo $barang->nama_suplayer ?></td>
            <td><?php echo $barang->nama_barang ?></td>
            <td><?php echo $barang->stok ?></td>
            <td><?php echo $barang->harga ?></td>
            <td><?php echo $barang->laba ?></td>
            <td style="text-align:center" width="200px">
                <?php 
                 
                echo anchor(site_url('barang/update/'.$barang->id_barang),'Update'); 
                echo ' | '; 
                echo anchor(site_url('barang/delete/'.$barang->id_barang),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                ?>
            </td>
        </tr>
                <?php
            }
            ?>  
        </table>