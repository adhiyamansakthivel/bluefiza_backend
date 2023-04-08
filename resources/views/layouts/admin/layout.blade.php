<!DOCTYPE html>
<html lang="en">

@include('layouts.admin.head')
<body class="hold-transition sidebar-mini layout-fixed">

  <div class="wrapper">

    
    @include('layouts.admin.navbar')

    @include('layouts.admin.sidebar')


    <div class="content-wrapper">

    @yield('body')
  
    </div>
    

  <!-- End #main -->
  @livewireScripts


  @include('layouts.admin.footer')

  
  </div>


  
</body>

</html>