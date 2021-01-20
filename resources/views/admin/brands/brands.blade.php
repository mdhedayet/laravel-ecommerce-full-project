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
            <h1>Brands</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Brands</li>
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
              <h3 class="card-title">Brands DataTable</h3>
              <a href="{{url('admin/add-edit-brand')}}" class="btn btn-sm btn-primary float-sm-right" >Add Brand</a>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $noId=1; ?>
                @foreach ($brands as $brand)
                <tr>
                  <td>{{$noId++}}</td>
                  <td>{{$brand->name}}</td>
                  <td>
                      @if ($brand->status == 1)
                      <a class="updateBrandstatus" id="brand-{{$brand->id}}" brand_id="{{$brand->id}}" style="color: rgb(0, 128, 0);" href="javascript:void(0)"><i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i></a>
                      @else
                      <a class="updateBrandstatus" id="brand-{{$brand->id}}" brand_id="{{$brand->id}}" style="color: rgb(255, 0, 0);" href="javascript:void(0)"><i class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i></a>
                      @endif
                  </td>
                  <td>
                    <a class="btn btn-success btn-sm " href="{{url('admin/add-edit-brand/'.$brand->id)}}" title="Edit Brand"><i class="fas fa-edit"></i></a>
                    &nbsp;
                    <a class="btn btn-danger btn-sm  confirmDelete" name="brand" nameid="{{$brand['id']}}" href="javascript:void(0)" title="Delete Brand"><i class="fas fa-trash"></i></a>
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