<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=tabungan_kantin_".date("Y-m-d").".xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>

 <table>
        <tr>
            <th>No</th>
            <th>Kode Kantin</th>
            <th>Nama Kantin</th>
            <th>Saldo</th>
        </tr>
        <?php
            $start = 0;
            $tabungan_data = $this->db->get('tabungan_kantin');
            foreach ($tabungan_data->result() as $tabungan){?>
        <tr>
            <td><?php echo ++$start; ?></td>
            <td><?php echo $tabungan->kode_kantin ?></td>
            <td><?php 
            $sql = $this->db->query("SELECT * FROM kantin where kode_kantin='$tabungan->kode_kantin'")->row();
            echo $sql->nama_kantin;
             ?></td>
            <td><?php echo 'Rp. '.number_format($tabungan->total_saldo) ?></td>
        
        </tr>
        <?php } ?>
        </table>