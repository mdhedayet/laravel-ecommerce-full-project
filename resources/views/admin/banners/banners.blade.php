@extends('layouts.admin_layout.admin_layout')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
         
      @if (Session::get('success_message'))
          <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{Session::get('success_message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
      @endif
      
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Banners</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Banners</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
 <!-- Main content -->
    <div class="content ">
      <div class="row mx-1">
        <div class="col-12 ">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Banners DataTable</h3>
              <a href="{{url('admin/add-edit-banner')}}" class="btn btn-sm btn-primary float-sm-right" >Add Banner</a>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Image</th>
                  <th>Link</th>
                  <th>Alt</th>
                  <th>Title</th>
                  <th style="width: 150px;">Description</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $noId=1; ?>
                @foreach ($banners as $banner)
                <tr>
                  <td>{{$noId++}}</td>
                  <td>
                  @if (!empty($banner['image']))
                        <div style="margin-left: 10px;margin-right: 10px;width: 120px;height: 120px;position: relative;overflow: hidden;border-radius: 5px;background-color: #ececec;">
                        <img src="{{asset('images/banner_images/'.$banner['image'])}}" alt="Avatar" style="display: inline;margin: 0 auto;height: 100%; vertical-align: middle;width: auto;">
                        </div>
                      @else
                        No Image
                      @endif
                  </td>
                  <td>{{$banner['link']}}</td>
                  <td>{{$banner['alt']}}</td>
                  <td>{{$banner['title']}}</td>
                  <td style="width: 150px;"><p>{{$banner['description']}}</p></td>
                  <td>
                      @if ($banner['status'] == 1)
                      <a class="updateBannerstatus" id="banner-{{$banner['id']}}" banner_id="{{$banner['id']}}" style="color: rgb(0, 128, 0);" href="javascript:void(0)"><i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i></a>
                      @else
                      <a class="updateBannerstatus" id="banner-{{$banner['id']}}" banner_id="{{$banner['id']}}" style="color: rgb(255, 0, 0);" href="javascript:void(0)"><i class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i></a>
                      @endif
                  </td>
                  <td>
                    <a class="btn btn-success btn-sm " href="{{url('admin/add-edit-banner/'.$banner['id'])}}" title="Edit banner"><i class="fas fa-edit"></i></a>
                    &nbsp;
                    <a class="btn btn-danger btn-sm  confirmDelete" name="banner" nameid="{{$banner['id']}}" href="javascript:void(0)" title="Delete banner"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.content -->
  </div>
 <!-- /.content-wrapper -->
  
@endsection