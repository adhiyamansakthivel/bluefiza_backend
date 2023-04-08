<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script type="text/javascript" src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <script type="text/javascript">
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <script type="text/javascript" src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
  <script type="text/javascript" src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
  <script type="text/javascript" src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('plugins/moment/moment.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
  <script type="text/javascript" src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('dist/js/adminlte.js')}}"></script>
  <script type="text/javascript" src="{{asset('dist/js/pages/dashboard.js')}}"></script>

  <script type="text/javascript" src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>

  <script type="text/javascript" src="{{asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>



  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });



    });
  </script>
  <script>
    window.addEventListener('swal', function(e) {
      Swal.fire(e.detail);
    });
    window.addEventListener('swal:delete', function(e) {
      Swal.fire(e.detail).then((result) => {
        if (result.isConfirmed) {
          Livewire.emit('deleteConfirmed')
          
        }
      });
    });
    $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
  
    window.addEventListener('show-edit', event => {
      $('#modal-default').modal('show');
    })
    window.addEventListener('show-edit-hide', event => {
      $('#modal-default').modal('hide');
    })

    window.addEventListener('show-view', event => {
      $('#modal-default-view').modal('show');
    })
    window.addEventListener('show-view-hide', event => {
      $('#modal-default-view').modal('hide');
    })
  </script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
