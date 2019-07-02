@extends('backend.admin_master')
@section('admin_main_content')

<main class="main-wrapper clearfix">
    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h5 class="mr-0 mr-r-5">Manage User</h5>
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Manage User</li>
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
                    <!-- /.widget-heading -->
                    <div class="widget-body clearfix">
                        <table class="table table-striped table-responsive" data-toggle="datatables">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>User E-mail</th>
                                    <th>User Access Level</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $index = 1; ?>
                                @foreach($admin as $v_admin)
                                <tr>
                                    <td>{{$index++}}</td>
                                    <td>{{$v_admin->admin_name}}</td>
                                    <td>{{$v_admin->email_address}}</td>
                                    <td>
                                        @if($v_admin->access_label=='1')
                                        <p>Super</p>
                                        @elseif($v_admin->access_label=='2') 
                                        <p>Manager</p>
                                        @else
                                        <p>Frontend User</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if($v_admin->activation_status=='1')
                                        <a <?php if ($v_admin->access_label == '2' || $v_admin->access_label == '3') { ?> href="{{URL::to('unpublish-user-status/'.$v_admin->admin_id)}}" <?php } ?> href='' class="btn btn-sm btn-success">Active</a>
                                        @else
                                        <a <?php if ($v_admin->access_label == '2' || $v_admin->access_label == '3') { ?> href="{{URL::to('publish-user-status/'.$v_admin->admin_id)}}" <?php } ?>  class="btn btn-sm btn-danger">Inactive</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if(($v_admin->access_label=='2'||$v_admin->access_label == '3') && $v_admin->admin_id!=Session::get('admin_id') )
                                        <a href="{{URL::to('edit-user/'.$v_admin->admin_id)}}" class="btn btn-sm btn-success">Edit</a>
                                        <a onclick="return confirm('Are you sure?')" href="{{URL::to('delete-user/'.$v_admin->admin_id)}}" class="btn btn-sm btn-danger">Delete</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
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