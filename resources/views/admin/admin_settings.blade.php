  @extends('layouts.admin_layout.admin_layout')
  @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Admin Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        @if (Session::has('error_message'))
          <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            {{Session::get('error_message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
      @endif
      @if (Session::get('success_message'))
          <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{Session::get('success_message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
      @endif
      @if ($errors->any())
         <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
          <ul class="nav justify-content-center">
              @foreach ($errors->all() as $error)
                  <li class="nav-item">{{ $error }}</li>
              @endforeach
          </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
      @endif
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
     <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Admin Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" action="{{url('/admin/update-admin-details')}}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Admin Name</label>
                    <input class="form-control" type="text" name="name" value="{{$adminDetails->name}}" placeholder="Enter your name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Admin Email</label>
                    <input class="form-control" type="email" name="email" value="{{$adminDetails->email}}" placeholder="Enter email address">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Admin Type</label>
                    <input class="form-control" type="text" name="type" value="{{$adminDetails->type}}" placeholder="Enter admin typr">
                  </div>
                  
                  
                    <div class="form-group">
                    <label for="exampleInputPassword1">Admin Number </label>
                    <input type="number" class="form-control" id="mobile" name="mobile" value="{{$adminDetails->mobile}}" placeholder="Enter mobile number" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Admin Profile Image</label>
                    <div class="row col-12" style="margin:0; padding:0;">
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputfilenamehere" name="admin_image" >
                        <label class="custom-file-label" for="inputfilenamehere">Choose file</label>
                      </div>
                        @if (!empty(Auth::guard('admin')->user()->image))
                        <input type="hidden" name="current_admin_image" value="{{Auth::guard('admin')->user()->image}}">
                        <div style="margin-left: 10px; width: 40px;height: 38px;position: relative;overflow: hidden;border-radius: 5px;background-color: #ececec;">
                        <img src="{{url('images/admin_images/admin_propic/'.Auth::guard('admin')->user()->image)}}" alt="Avatar" style="display: inline;margin: 0 auto;height: 100%; vertical-align: middle;width: auto;">
                        </div>
                        @endif
                    </div>
                    
                   </div>
                  </div>
                  </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!-- right colam -->
           <div class="col-md-6">
     <!-- general form elements -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Update Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" action="{{url('admin/update_pwd')}}" method="post">
                @csrf
              <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Admin Email</label>
                    <input class="form-control" readonly="" value="{{$adminDetails->email}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Admin Type</label>
                    <input class="form-control" readonly="" value="{{$adminDetails->type}}">
                  </div>
                  
                  
                    <div class="form-group">
                    <label for="exampleInputPassword1">Current Password </label>
                    <label id="checkCurrentPassword" class="float-right"></label>
                    <input type="password" class="form-control" id="current_pwd" name="current_pwd" placeholder="Enter Current Password" required="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">New Password</label>
                    <input type="password" class="form-control" id="new_pwd" name="new_pwd" placeholder="Enter New Password" required="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Confirm Password</label><label id="message" class="float-right"></label>
                    <input type="password" class="form-control" id="confirm_pwd" name="confirm_pwd" placeholder="Enter Confirm Password" required="">
                  </div>
                  </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-warning">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          </div>
          </div>

  </div>
   @endsection