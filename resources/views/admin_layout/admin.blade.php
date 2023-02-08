<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="backend/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="backend/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="backend/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="backend/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="backend/plugins/summernote/summernote-bs4.min.css">
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

{{-- start header --}}
    @include('admin_layout.header')
{{-- end header --}}



  {{-- start left sidebar --}}
    @include('admin_layout.leftsidebar')
  {{-- end left sidebar --}}
  
  {{-- start content --}}
    @yield('content')
  {{-- end content --}}

  {{-- start footer --}}
  @include('admin_layout.footer')
  {{-- end footer --}}
<!-- ./wrapper -->

<!-- jQuery -->
<script src="backend/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="backend/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Popper-->
<script src="backend/plugins/popper/umd/popper.min.js"></script>
<!-- Bootstrap 4 -->
<script src="backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap Confirmation-->
<script src="backend/plugins/bootstrap-confirmation/bootstrap-confirmation.js"></script>
<!-- ChartJS -->
<script src="backend/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="backend/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="backend/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="backend/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="backend/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="backend/plugins/moment/moment.min.js"></script>
<script src="backend/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="backend/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="backend/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="backend/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="backend/dist/js/pages/dashboard.js"></script>

<script type="text/javascript">
  $(document).ready(function () {
      $('#master').on('click', function(e) {
       if($(this).is(':checked',true))  
       {
          $(".sub_chk").prop('checked', true);  
       } else {  
          $(".sub_chk").prop('checked',false);  
       }  
      });

      $('.delete_all').on('click', function(e) {
          var allVals = [];  
          $(".sub_chk:checked").each(function() {  
              allVals.push($(this).attr('data-id'));
          });  
          if(allVals.length <=0)  
          {  
              alert("Por favor selecione uma linha");  
          }  else {  
              var check = confirm("Tem certeza que quer remover esta linha?");  
              if(check == true){  
                  var join_selected_values = allVals.join(","); 
                  $.ajax({
                      url: $(this).data('url'),
                      type: 'DELETE',
                      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                      data: 'ids='+join_selected_values,
                      success: function (data) {
                          if (data['success']) {
                              $(".sub_chk:checked").each(function() {  
                                  $(this).parents("tr").remove();
                              });
                              alert(data['success']);
                          } else if (data['error']) {
                              alert(data['error']);
                          } else {
                              alert('Algo deu errado!!!');
                          }
                      },
                      error: function (data) {
                          alert(data.responseText);
                      }
                  });
                $.each(allVals, function( index, value ) {
                    $('table tr').filter("[data-row-id='" + value + "']").remove();
                });
              }  
          }  
      });
      $('[data-toggle=confirmation]').confirmation({
          rootSelector: '[data-toggle=confirmation]',
          onConfirm: function (event, element) {
              element.trigger('confirm');
          }
      });
      $(document).on('confirm', function (e) {
          var ele = e.target;
          e.preventDefault();
          $.ajax({
              url: ele.href,
              type: 'DELETE',
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              success: function (data) {
                  if (data['success']) {
                      $("#" + data['tr']).slideUp("slow");
                      alert(data['success']);
                  } else if (data['error']) {
                      alert(data['error']);
                  } else {
                      alert('Algo deu errado!!!');
                  }
              },
              error: function (data) {
                  alert(data.responseText);
              }
          });
          return false;
      });
  });
</script>
</body>


</html>
