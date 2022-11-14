<div class="container-fluid bg-dark text-white-50 py-5 px-sm-3 px-lg-5">
  <div class="row pt-5">
    <div class="col-lg-4 col-md-6 mb-5">
      <a href="" class="navbar-brand">
        <h1 class="text-primary"><span class="text-white">Rote</span>Ndao</h1>
      </a>
      <p>Terwujudnya Masyarakat Rote Ndao Yang BERMARTABAT Dan Berkelanjutan Bertumpu Pada Pariwisata Yang Didukung Oleh Pertanian dan Perikanan</p>
      <h6 class="text-white text-uppercase mt-4 mb-3" style="letter-spacing: 5px;">Ikuti kami</h6>
      <div class="d-flex justify-content-start">
        <a class="btn btn-outline-primary btn-square mr-2" href="https://www.facebook.com/disbudparrotendao/" target="_blank"><i class="fab fa-facebook"></i></a>
        <a class="btn btn-outline-primary btn-square mr-2" href="https://twitter.com/BpnNdao" target="_blank"><i class="fab fa-twitter"></i></a>
        <a class="btn btn-outline-primary btn-square mr-2" href="https://www.instagram.com/disbudparrotendao/" target="_blank"><i class="fab fa-instagram"></i></a>
        <a class="btn btn-outline-primary btn-square" href="https://play.google.com/store/apps/details?id=id.explorerotecom.android5fcdb3319b900&hl=in&gl=US&pli=1" target="_blank"><i class="fab fa-app-store"></i></a>
      </div>
    </div>
    <div class="col-lg-8 col-md-6 mb-5">
      <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">PELAYANAN KAMI</h5>
      <div class="d-flex flex-column justify-content-start">
        <a class="text-white-50 mb-2" href="penduduk"><i class="fa fa-angle-right mr-2"></i>Penduduk</a>
        <a class="text-white-50 mb-2" href="pariwisata"><i class="fa fa-angle-right mr-2"></i>Pariwisata</a>
        <a class="text-white-50 mb-2" href="fasilitas"><i class="fa fa-angle-right mr-2"></i>Fasilitas</a>
        <a class="text-white-50 mb-2" href="wisata"><i class="fa fa-angle-right mr-2"></i>Wisata</a>
        <a class="text-white-50 mb-2" href="pengunjung"><i class="fa fa-angle-right mr-2"></i>Pengunjung</a>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
  <div class="row">
    <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
      <p class="m-0 text-white-50">Copyright &copy; <a href="https://netmedia-framecode.com" target="_blank">Netmedia Framecode</a>. All Rights Reserved.</a>
      </p>
    </div>
    <div class="col-lg-6 text-center text-md-right">
      <p class="m-0 text-white-50">Powered by <a href="https://pariwisata-rote.tugasakhir.my.id" target="_blank">Ribka Lay</a>
      </p>
    </div>
  </div>
</div>

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/easing.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/moment-timezone.min.js"></script>
<script src="assets/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Template Javascript -->
<script src="assets/js/main.js"></script>
<script src="assets/js/jquery-3.5.1.min.js"></script>
<script>
  const messageSuccess = $('.message-success').data('message-success');
  const messageInfo = $('.message-info').data('message-info');
  const messageWarning = $('.message-warning').data('message-warning');
  const messageDanger = $('.message-danger').data('message-danger');

  if (messageSuccess) {
    Swal.fire({
      icon: 'success',
      title: 'Berhasil Terkirim',
      text: messageSuccess,
    })
  }

  if (messageInfo) {
    Swal.fire({
      icon: 'info',
      title: 'For your information',
      text: messageInfo,
    })
  }
  if (messageWarning) {
    Swal.fire({
      icon: 'warning',
      title: 'Peringatan!!',
      text: messageWarning,
    })
  }
  if (messageDanger) {
    Swal.fire({
      icon: 'error',
      title: 'Kesalahan',
      text: messageDanger,
    })
  }
</script>