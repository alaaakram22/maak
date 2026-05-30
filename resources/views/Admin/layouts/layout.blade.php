@include('admin.layouts.header')
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

 @include('admin.layouts.sidebar')
       

            

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                
            @include('admin.layouts.topbar')


            @yield('body')
           @include('admin.layouts.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    

   
</body>

