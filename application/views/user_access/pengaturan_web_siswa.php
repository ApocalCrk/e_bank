<style type="text/css">
	.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
.blink {
	animation: blinker 1.5s linear infinite;
}
@keyframes blinker {  
    50% { opacity: 0; }
}
</style>
<div class="d-flex justify-content-center">
	<table class="table" style="width: 90%">
	<tr>
		<td>Dark Mode&nbsp;&nbsp;<span class="badge badge-danger badge-counter"><i class="blink">Beta!</i></span>
			<label class="switch" style="float: right;">
  				<input type="checkbox" id="dark" onclick="dark_mode()">
  				<span class="slider round"></span>
			</label>
		</td>
	</tr>
	<tr>
		<td class="text-center">Coming Soon!</td>
	</tr>
</table>
</div>

<script type="text/javascript">
	function dark_mode(){
		var cek = document.getElementById("dark");
		if (cek.checked == true) {
			location.href = "Siswaui/beta_dark_mode";
		}else{
			
		}
	}
</script>