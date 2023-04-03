<!doctype html>
<html lang="en">
@include('Admin.Layout.head')

  <body>
    <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">
      <!-- Side Overlay-->
    @include('sweetalert::alert')

      @include('Admin.Layout.aside')
     @include('Admin.Layout.sidebar')
      <!-- END Sidebar -->

      <!-- Header -->
        @include('Admin.Layout.header')
      <!-- END Header -->

      <!-- Main Container -->
      <main id="main-container">
        @yield('main_section')
      </main>
      <!-- END Main Container -->

      <!-- Footer -->
      @include('Admin.Layout.footer')
      <!-- END Footer -->
    </div>
    <!-- END Page Container -->

    <!--
        OneUI JS

        Core libraries and functionality

    -->
    @yield('custom_js')
    @include('Admin.Layout.scripts')
  </body>
</html>
