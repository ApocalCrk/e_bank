function openQRCamera(node) {
  var reader = new FileReader();
  reader.onload = function() {
    node.value = "";
    qrcode.callback = function(res) {
      if(res instanceof Error) {
        Swal.fire({
          text:'QR code tidak terbaca.Pastikan QR code masuk dalam frame kamera.',
          type: 'error',
          showConfirmButton: false,
          timer: 1000
        })        
      } else {
        Swal.fire({
          type: 'success',
          text: 'Qr Code Terbaca',
          showConfirmButton: false,
          timer: 1000,
        });
        node.parentNode.previousElementSibling.value = res;
        window.setTimeout(function() {
        document.getElementById("submit").click();
    }, 1000);
      }
    };
    qrcode.decode(reader.result);
  };
  reader.readAsDataURL(node.files[0]);
}

function showQRIntro() {
  return confirm("Izinkan kamera untuk mengambil gambar QR code");
}