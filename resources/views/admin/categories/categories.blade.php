@extends('layouts.admin_layout.admin_layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catalogues</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
 <!-- Main content -->
    <div class="content ">
      <div class="row mx-1">
        <div class="col-12 ">
          @if (Session::get('success_message'))
          <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{Session::get('success_message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
      @endif
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Categories DataTable</h3> 
            <a href="{{url('admin/add-edit-category')}}" class="btn btn-primary float-sm-right" >Add Category</a>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Category</th>
                  <th>Parent Category</th>
                  <th>Section</th>
                  <th>Url</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $noId=1; ?>
                @foreach ($categories as $category)
                @if (!isset($category->parentcategory->category_name))
                    <?php $data_name="Root"; ?>
                @else
                    <?php $data_name=$category->parentcategory->category_name; ?>
                @endif
                <tr>
                  <td>{{$noId++}}</td>
                  <td>{{$category->category_name}}</td>
                  <td>{{$data_name}}</td>
                  <td>{{$category->section->name}}</td>
                  <td>{{$category->url}}</td>
                  <td>
                      @if ($category->status == 1)
                      <a class="updateCategoryStatus" id="category-{{$category->id}}" category_id="{{$category->id}}" style="color: rgb(0, 128, 0);" href="javascript:void(0)">Active</a>
                      @else
                      <a class="updateCategoryStatus" id="category-{{$category->id}}" category_id="{{$category->id}}" style="color: rgb(255, 0, 0);" href="javascript:void(0)">Inactive</a>
                      @endif
                  </td>
                <td >
                  <a class="btn btn-primary btn-sm px-3" href="{{url('admin/add-edit-category/'.$category->id)}}">Edit</a>
                  &nbsp;&nbsp;
                <a class="btn btn-danger btn-sm px-2 confirmDelete" name="category" nameid="{{$category->id}}" href="javascript:void(0)" {{-- href="{{url('admin/delete-category/'.$category->id)}}" --}}>Delete</a>
                
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