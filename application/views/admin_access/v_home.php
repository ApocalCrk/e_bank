<div class="row">
	<div class="col-xs-6 col-md-4 col-lg-4 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-building color-blue"></em>
							<div class="large">
								<?php 
								$sql=$this->db->query("SELECT * FROM kantin");
								 echo $sql->num_rows();
								 ?>
							</div>
							<div class="text-muted">Jumlah Kantin</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-4 col-lg-4 no-padding">
					<div class="panel panel-blue panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-users color-orange"></em>
							<div class="large">
								<?php 
								$sql=$this->db->query("SELECT * FROM kurir");
								echo $sql->num_rows();
								 ?>
							</div>
							<div class="text-muted">Jumlah Kurir</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-4 col-lg-4 no-padding">
					<div class="panel panel-orange panel-widget border-right">
						<div class="row no-padding"><a href="siswa"><em class="fa fa-xl fa-users color-teal"></em></a>
							<div class="large">
								<?php 
								$sql=$this->db->query("SELECT * FROM user");
								echo $sql->num_rows();
								 ?>
							</div>
							<div class="text-muted">Jumlah User</div>
						</div>
					</div>
				</div>
</div>