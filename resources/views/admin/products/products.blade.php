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
              <li class="breadcrumb-item active">Products</li>
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
              <h3 class="card-title">Products Table</h3>
            <a href="{{url('admin/add-edit-product')}}" class="btn btn-sm btn-primary float-sm-right" >Add Product</a>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Product Name</th>
                  <th>Product Code</th>
                  <th>Product Color</th>
                  <th>Product Image</th>
                  <th>Product Video</th>
                  <th>Category</th>
                  <th>Section</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $noId=1; ?>
                @foreach ($products as $product)
                <tr>
                  <td>{{$noId++}}</td>
                  <td>{{$product->product_name}}</td>
                  <td>{{$product->product_code}}</td>
                  <td>{{$product->product_color}}</td>
                  <td> @if (!empty($product->main_image))
                        <div style="margin-left: 10px;margin-right: 10px;width: 120px;height: 120px;position: relative;overflow: hidden;border-radius: 5px;background-color: #ececec;">
                        <img src="{{asset('images/product_images/large/'.$product->main_image)}}" alt="Avatar" style="display: inline;margin: 0 auto;height: 100%; vertical-align: middle;width: auto;">
                        </div>
                      @else
                        No Image
                      @endif
                  </td>
                  <td>
                    @if (!empty($product->product_video))
                    <div style="margin-left: 10px;margin-right: 10px;width: 220px;height:120px; position: relative;overflow: hidden;border-radius: 5px;background-color: #ececec;"><video width="220" controls>
                            <source src="{{asset('videos/product_videos/'.$product->product_video)}}" type="video/mp4">
                            <source src="{{asset('videos/product_videos/'.$product->product_video)}}" type="video/ogg">
                            <source src="{{asset('videos/product_videos/'.$product->product_video)}}" type="video/webm">
                            Your browser does not support HTML video.
                          </video>
                        </div>
                    @else
                    No Video
                    @endif
                  </td>
                  <td>{{$product->category->category_name}}</td>
                  <td>{{$product->section->name}}</td>
                  <td>
                      @if ($product->status == 1)
                      <a class="updateproductStatus" id="product-{{$product->id}}" product_id="{{$product->id}}" style="color: rgb(0, 128, 0);" href="javascript:void(0)">Active</a>
                      @else
                      <a class="updateproductStatus" id="product-{{$product->id}}" product_id="{{$product->id}}" style="color: rgb(255, 0, 0);" href="javascript:void(0)">Inactive</a>
                      @endif
                  </td>
                <td >
                    <a class="btn btn-success btn-sm " href="{{url('admin/add-edit-attribute/'.$product->id)}}" title="Add/Edit Attribute"><i class="fas fa-plus"></i></a>
                    &nbsp;
                    <a class="btn btn-primary btn-sm " href="{{url('admin/add-edit-product/'.$product->id)}}" title="Edit Product"><i class="fas fa-edit"></i></a>
                  &nbsp;
                <a class="btn btn-danger btn-sm  confirmDelete" name="product" nameid="{{$product->id}}" href="javascript:void(0)" {{-- href="{{url('admin/delete-product/'.$product->id)}}" --}} title="Delete Product"><i class="fas fa-trash"></i></a>

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
