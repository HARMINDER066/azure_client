<!DOCTYPE html>
<html>
<head>
  
  @includeif('admin.partial.head')
   <style>
      .table-responsive {
    display: inline-table;
    /* width: 100%; */
    /* overflow-x: auto; */
}
  </style>
</head>

<body>
      <div class="theme-loader">
         <div class="ball-scale">
            <div class='contain'>
               <div class="ring">
                  <div class="frame"></div>
               </div>
               <div class="ring">
                  <div class="frame"></div>
               </div>
               <div class="ring">
                  <div class="frame"></div>
               </div>
               <div class="ring">
                  <div class="frame"></div>
               </div>
               <div class="ring">
                  <div class="frame"></div>
               </div>
               <div class="ring">
                  <div class="frame"></div>
               </div>
               <div class="ring">
                  <div class="frame"></div>
               </div>
               <div class="ring">
                  <div class="frame"></div>
               </div>
               <div class="ring">
                  <div class="frame"></div>
               </div>
               <div class="ring">
                  <div class="frame"></div>
               </div>
            </div>
         </div>
      </div>
      <div id="pcoded" class="pcoded">
         <div class="pcoded-overlay-box"></div>
         <div class="pcoded-container navbar-wrapper">
    @include('admin.partial.nav')
    
    <div class="pcoded-main-container">
               <div class="pcoded-wrapper">
    @include('admin.partial.sidebar')


  <!-- Content Wrapper. Contains page content -->
      @yield('content')
</div>
</div>
  </div>
</div>
</div>
  <!-- /.content-wrapper -->

  @include('admin.partial.footer')
</body>
</html>
