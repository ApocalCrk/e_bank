<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=data_barang_".date('Y-m-d').".xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>

 <table>
            <tr>
            <th>No</th>
            <th>Kode Produk/Barang</th>
            <th>Nama Produk/Barang</th>
            <th>Satuan</th>
            <th>Stok Produk/Barang</th>
            <th>Kategori</th>
            <th>Harga Pokok</th>
            <th>Harga JUal</th>
            </tr><?php
            $start = 0;
            $barang_data = $this->db->query("SELECT * FROM barang WHERE key_barang='$kode_kantin'");
            foreach ($barang_data->result() as $barang)
            {
                ?>
                <tr>
            <td><?php echo  ++$start ?></td>
            <td><?php echo $barang->kode_barang ?></td>
            <td><?php echo $barang->nama_barang ?></td>
            <td><?php echo $satuan ?></td>
            <td><?php echo $barang->stok ?></td>
            <td><?php echo $barang->kategori ?></td>
            <td><?php echo 'Rp. '.number_format($barang->harga_pokok) ?></td>
            <td><?php echo 'Rp. '.number_format($barang->harga_jual) ?></td>
            
        </tr>
                <?php
            }
            ?>
        </table>