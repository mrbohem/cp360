<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title>@yield('title')</title>
     <link rel=stylesheet href={{ asset('vendors/mdi/css/materialdesignicons.min.css')}}>
     <link rel=stylesheet href={{ asset('vendors/css/vendor.bundle.base.css')}}>
     <link rel=stylesheet href={{ asset('css/style.css')}}>
     <link rel=shortcut icon href={{ asset('images/favicon.ico')}} />
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
     @livewireStyles
     <style>
          .swal2-container {
               z-index: 100000;
          }
     </style>
     @stack('css')
</head>

<body>
     <div class="container-scroller">
          <div class="container-fluid page-body-wrapper">
               @if(Route::current()->getName() != "login")
               <livewire:component.sidebar />
               @endif
               <div class="main-panel">
                    {{ $slot }}
               </div>
          </div>
     </div>
     <script src="{{ asset('js/app.js') }}"></script>
     <script src={{ asset('vendors/js/vendor.bundle.base.js') }}></script>
     <script src={{ asset('vendors/chart.js/Chart.min.js') }}></script>
     <script src={{ asset('js/off-canvas.js') }}></script>
     <script src={{ asset('js/hoverable-collapse.js') }}></script>
     <script src={{ asset('js/misc.js') }}></script>
     <script src={{ asset('js/todolist.js') }}></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
     @livewireScripts
     <script>
          $(function(){
               window.addEventListener('swal',function(e){
                    Swal.fire(e.detail);
               });
               window.addEventListener('closeModal',function(e){
                    $(".modal").modal('hide');
               });
               
               window.addEventListener('refreshSelectPicker',function(e){
                    $('.selectpicker').selectpicker('refresh')
               });
          });
          $(".modal").on('hidden.bs.modal',function(){
               livewire.emit('clearProps');
          });
     </script>
     @stack('js')
</body>
</html>