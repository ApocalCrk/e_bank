<style type="text/css">
    #bulan_ei {
        display: none;
    }
    #bulan_ei:not(*:root) { /* Supports only WebKit browsers */
        display: block;
    }
    #bulan_ei:not(*:root) ~ #bulan,#tahun { /* Supports only WebKit browsers */
        display: none;
    }
</style>
<div class="body" style="padding-left: 10px;padding-right: 10px">
<form action="" method="POST">
    <div class="row col">
    <div class="form-group">
        <label>Bulan</label>
        <input type="month" name="bulan_ei" id="bulan_ei" class="form-control">
        <select class="form-control" name="bulan" id="bulan">
            <option value=""></option>
            <option value="1">Januari</option>
            <option value="2">Februari</option>
            <option value="3">Maret</option>
            <option value="4">April</option>
            <option value="5">Mei</option>
            <option value="6">Juni</option>
            <option value="7">Juli</option>
            <option value="8">Agustus</option>
            <option value="9">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
        </select>
    </div>
    <div class="form-group ml-1" id="tahun">
        <label>Tahun</label>
        <select name="tahun" class="form-control">
            <option value=""></option>
            <?php for ($i=2000; $i <= 2100 ; $i++) { ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
        </select>
    </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<div class="table-responsive mt-3">
<table class="table" id="dataTable">
    <thead align="center">
        <tr>
        <th>Kode Pembelian</th>
        <th>Total Harga</th>
        <th>Tanggal Pembelian</th>
        <th>Aksi</th>
        </tr>
    </thead>
    <tbody align="center">
    <?php 
        $bulan_ei = $this->input->post('bulan_ei');
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');
        $nis = $this->session->userdata('nis');
        if ($bulan != "") {
        $sql = $this->db->query("SELECT * FROM penjualan_header where nis='$nis' and MONTH(tgl_penjualan)='$bulan' and YEAR(tgl_penjualan)='$tahun'");
        foreach ($sql->result() as $row){?>
        <tr>
        <td><?php echo $row->kode_penjualan ?></td>
        <td><?php echo 'Rp. '.number_format($row->total_harga) ?></td>
        <td><?php echo $row->tgl_penjualan ?></td>
        <td><a href="<?php echo site_url('Siswaui/read_data_pen_siswa/'.$row->id_penjualan) ?>" class="btn btn-info">Detail</a></td>
    <?php } ?>
    <?php }else{
        $data_bulan = explode('-', $bulan_ei);
        $sql = $this->db->query("SELECT * FROM penjualan_header where nis='$nis' and MONTH(tgl_penjualan)='$data_bulan[1]' and YEAR(tgl_penjualan)='$data_bulan[0]'");
        foreach ($sql->result() as $row){?>
        <tr>
        <td><?php echo $row->kode_penjualan ?></td>
        <td><?php echo 'Rp. '.number_format($row->total_harga) ?></td>
        <td><?php echo $row->tgl_penjualan ?></td>
        <td><a href="<?php echo site_url('Siswaui/read_data_pen_siswa/'.$row->id_penjualan) ?>" class="btn btn-info">Detail</a></td>
    <?php } ?>
    <?php } ?>
    </tbody>
</table>
</div>
</div>