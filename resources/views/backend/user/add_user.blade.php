@extends('backend.admin_master')
@section('admin_main_content')

<main class="main-wrapper clearfix">
    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h5 class="mr-0 mr-r-5">Add User</h5>
            <!--<p class="mr-0 text-muted d-none d-md-inline-block">statistics, charts, events and reports</p>-->
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Add User</li>
            </ol>
        </div>
        <!-- /.page-title-right -->
    </div>
    <!-- /.page-title -->
    <!-- =================================== -->
    <!-- Different data widgets ============ -->
    <!-- =================================== -->
    <div class="widget-list">
        <div class="row">
            <div class="col-md-12 widget-holder">
                <div class="widget-bg">
                    <div class="widget-body clearfix">
                        <!-- @@@@@@@@@@ Start Messages @@@@@@@@@@@@ -->
                        @if(Session::has('success'))
                        <div class="alert alert-success alert-icon-left" role="alert">

                            <div class="float-xs-left">
                                <i class="fa fa-check"></i>   <strong>Success !</strong> {{Session::get('success')}}.
                            </div>
                        </div>
                        @elseif(Session::has('error'))
                        <div class="alert alert-danger alert-icon-left" role="alert">

                            <div class="float-xs-left">
                                <i class="fa fa-times-circle"></i>   <strong>Opps !</strong> {{Session::get('error')}}.
                            </div>
                        </div>
                        @endif
                        <!-- @@@@@@@@@@ End Messages @@@@@@@@@@@@ -->
                        {!! Form::open(['url' => '/save-user','method'=>'post','role'=>'form','files' => true, 'enctype' => 'multipart/form-data' ]) !!}

                        <input type="hidden" value="{{Session::get('admin_id')}}" name="admin_id">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="l0">User Name:</label>
                            <div class="col-md-9">
                                <input class="form-control" id="l0" type="text" name="user_name" placeholder="User Name" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="l0">User E-mail:</label>
                            <div class="col-md-9">
                                <input class="form-control" id="l0" type="email" name="user_email" placeholder="User E-mail" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="l0">User Password:</label>
                            <div class="col-md-9">
                                <input class="form-control" id="l0" type="password" name="user_password" placeholder="User Password" required>
                            </div>
                        </div>

                                                
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="l13">User Access Level:</label>
                            <div class="col-md-9">
                                <select class="form-control" id="l13" name="access_label" required>
                                    <option value="" disabled selected>Select Access Level</option>
                                    <option value="1">Super</option>
                                    <option value="2">Manager</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="l13">User Status:</label>
                            <div class="col-md-9">
                                <select class="form-control" id="l13" name="status" required>
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="form-group row">
                                <div class="col-md-9 ml-md-auto btn-list">
                                    <button class="btn btn-primary btn-rounded" type="submit">Submit</button>
                                    <button class="btn btn-outline-default btn-rounded" type="reset">Cancel</button>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
            <!-- /.widget-holder -->

        </div>
        <!-- /.row -->
    </div>
    <!-- /.widget-list -->
</main>

@endsection