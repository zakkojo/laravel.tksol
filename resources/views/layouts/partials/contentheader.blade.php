<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @yield('contentheader_title')
        <small>@yield('contentheader_description')</small>
    </h1>
    @section('contentheader_breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol>
    @show
</section>