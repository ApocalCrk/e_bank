<!-- <div class="text-center">
	<h5>Sorry this menu can't work for this time</h5>
	<img src="image/maintenance/apologize.gif">
</div> -->
<div class="col-md-4 container">
	<a class="align-items-center box-mes" 
		style=
		"width: 100%;
		height: 100px;
		background: rgba(255,255,255,100);
		display: inline-flex;
		top: 20px;
		position: relative;
		text-decoration: none;
		color: inherit;
		border-radius: 10px;" onclick="moreProb()" 
		>
		<i class="rounded-circle fa fa-user" style="font-size: 200%;margin-left: 20px;border: 1px solid #ccc;padding: 10px;box-shadow: 1px 1px 1px 0px #ccc"></i>
		<p style="position: relative;top:8px;left: 20px;width: 250px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
			Masalah Akun
		</p>
		<i class="fa fa-angle-down" style="font-size: 25px;margin-top: 2px;" id="rot_1"></i>
	</a>
	<style type="text/css">
		.prob_acc {
			width: 100%;
			height: auto;
			background-color: none;
			display: inline-flex;
		}
			.prob_acc:hover{
			background-color: #d2e3fc;
		}
	</style>
	<div id="showMore_1" style="display: none;">
		<a href="" 
		style="width: 100%;height: 50px;background-color: #e8f0fe;display: inline-flex;position: relative;color: inherit;padding-top: 12px;padding-bottom: 12px;text-decoration: none;">
			<span class="prob_acc"><p style="margin-left: 12px">Password</p></span>
		</a>
		<a href="" 
		style="width: 100%;height: 50px;background-color: #e8f0fe;display: inline-flex;position: relative;color: inherit;padding-top: 12px;padding-bottom: 12px;text-decoration: none;">
			<span class="prob_acc"><p style="margin-left: 12px">Data Profile</p></span>
		</a>
		<a href="" 
		style="width: 100%;height: 50px;background-color: #e8f0fe;display: inline-flex;position: relative;color: inherit;padding-top: 12px;padding-bottom: 12px;text-decoration: none;">
			<span class="prob_acc"><p style="margin-left: 12px">Banned</p></span>
		</a>
		<a href="" 
		style="width: 100%;height: 50px;background-color: #e8f0fe;display: inline-flex;position: relative;color: inherit;padding-top: 12px;padding-bottom: 12px;text-decoration: none;">
			<span class="prob_acc"><p style="margin-left: 12px">Hapus Akun</p></span>
		</a>
	</div>

	<a class="align-items-center box-mes" 
		style=
		"width: 100%;
		height: 100px;
		background: rgba(255,255,255,100);
		display: inline-flex;
		position: relative;
		text-decoration: none;
		color: inherit;
		border-radius: 0 0 10px 10px;" onclick="moreTab()" 
		>
		<i class="rounded-circle fa fa-suitcase" style="font-size: 200%;margin-left: 20px;border: 1px solid #ccc;padding: 10px;box-shadow: 1px 1px 1px 0px #ccc"></i>
		<p style="position: relative;top:8px;left: 20px;width: 250px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
			Masalah Tabungan
		</p>
		<i class="fa fa-angle-down" style="font-size: 25px;margin-top: 2px;" id="rot_3"></i>
	</a>
	<style type="text/css">
		.prob_acc {
			width: 100%;
			height: auto;
			background-color: none;
			display: inline-flex;
		}
			.prob_acc:hover{
			background-color: #d2e3fc;
		}
	</style>
	<div id="showMore_3" style="display: none;margin-top: -5px">
		<a href="" 
		style="width: 100%;height: 50px;background-color: #e8f0fe;display: inline-flex;position: relative;color: inherit;padding-top: 12px;padding-bottom: 12px;text-decoration: none;border-radius: 0 0 10px 10px">
			<span class="prob_acc"><p style="margin-left: 12px">Saldo</p></span>
		</a>
	</div>

</div>

<script type="text/javascript">
function moreProb() {
  var x = document.getElementById("showMore_1");
  var fa = document.getElementById("rot_1");
  if (x.style.display === "none") {
    x.style.display = "block";
    fa.style.transform = "rotate(180deg)"
  } else {
    x.style.display = "none";
    fa.style.transform = "rotate(0deg)"
  }
} 
</script>
<script type="text/javascript">
function morePay() {
  var x = document.getElementById("showMore_2");
  var fa = document.getElementById("rot_2");
  if (x.style.display === "none") {
    x.style.display = "block";
    fa.style.transform = "rotate(180deg)"
  } else {
    x.style.display = "none";
    fa.style.transform = "rotate(0deg)"
  }
} 
</script>
<script type="text/javascript">
function moreTab() {
  var x = document.getElementById("showMore_3");
  var fa = document.getElementById("rot_3");
  if (x.style.display === "none") {
    x.style.display = "block";
    fa.style.transform = "rotate(180deg)"
  } else {
    x.style.display = "none";
    fa.style.transform = "rotate(0deg)"
  }
} 
</script>	