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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{$title}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
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
      @if (Session::get('success_message'))
          <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{Session::get('success_message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
      @endif
        <!-- SELECT2 EXAMPLE -->
      <form @if(empty($categoryData['id'])) action="{{url('admin/add-edit-category')}}" @else action="{{url('admin/add-edit-category/'.$categoryData['id'])}}" @endif  method="post" enctype="multipart/form-data">
            @csrf
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">{{$title}}</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                  <input class="form-control" type="text" name="category_name" id="category_name" @if(!empty($categoryData['category_name'])) value="{{$categoryData['category_name']}}" @else value="{{old('category_name')}}" @endif placeholder="Enter category name">
                  </div>
                  <div id="appenCategoryLavel">
                    @include('admin.categories.appen_add_category')
                  </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Category Discount Percentage</label>
                    <input class="form-control" type="number" name="category_discount" id="category_discount"  placeholder="Enter discount 1 to 100" @if(!empty($categoryData['category_discount'])) value="{{$categoryData['category_discount']}}" @else value="{{old('category_discount')}}" @endif>
                  </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Category Description</label>
                    <textarea class="form-control" rows="3" name="description" id="description" placeholder="Enter Category Description">@if(!empty($categoryData['description'])){{$categoryData['description']}}@else{{old('description')}}@endif</textarea>
                  </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Meta Description</label>
                    <textarea class="form-control" name="meta_description" id="meta_description" rows="3" placeholder="Enter Meta Description">@if(!empty($categoryData['meta_description'])){{$categoryData['meta_description']}}@else{{old('meta_description')}}@endif</textarea>
                  </div>
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                  <div class="form-group">
                  <label>Select Section</label>
                  <select name="section_id" id="section_id" class="form-control select2" style="width: 100%;">
                    <option value="" selected="selected">Select</option>
                    @foreach ($sections as $section)
                  <option value="{{$section->id}}" @if(!empty($categoryData['section_id']) && $categoryData['section_id'] == $section->id ) selected="selected" @endif>{{$section->name}}</option>
                    @endforeach
                  </select>
                </div>
                
                <div class="form-group">
                    <label for="exampleInputFile">Category Image</label>
                    <div class="row col-12" style="margin:0; padding:0;">
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputfilenamehere" name="category_image" >
                        <label class="custom-file-label" for="inputfilenamehere">Choose file</label>
                      </div>
                        @if (!empty($categoryData['category_image']))
                        <input type="hidden" name="current_category_image" value="{{$categoryData['category_image']}}">
                        <div style="margin-left: 10px;margin-right: 10px;width: 40px;height: 38px;position: relative;overflow: hidden;border-radius: 5px;background-color: #ececec;">
                        <img src="{{asset('images/category_images/'.$categoryData['category_image'])}}" alt="Avatar" style="display: inline;margin: 0 auto;height: 100%; vertical-align: middle;width: auto;">
                        </div>
                        <a class="btn btn-danger" href="{{url('admin/delete-category-image/'.$categoryData['id'])}}"> Delete Image</a>
                        @endif

                    </div>
                    
                   </div>
                  </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Category Url</label>
                    <input class="form-control" type="text" name="url" id="url" placeholder="Enter category Url" @if(!empty($categoryData['url'])) value="{{$categoryData['url']}}" @else value="{{old('url')}}" @endif>
                  </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Meta Title</label>
                    <textarea class="form-control" name="meta_title" id="meta_title" rows="3" placeholder="Enter Meta Title">@if(!empty($categoryData['meta_title'])){{$categoryData['meta_title']}}@else{{old('meta_title')}}@endif</textarea>
                  </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Meta Keywords</label>
                    <textarea class="form-control" name="meta_keywords" id="meta_keywords" rows="3" placeholder="Enter Meta Keywords">@if(!empty($categoryData['meta_keywords'])){{$categoryData['meta_keywords']}}@else{{old('meta_keywords')}}@endif</textarea>
                  </div>
              </div>
              <!-- /.col -->
            </div>

          </div>
          <!-- /.card-body -->
          <div class="card-footer">
           <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
        </form>
      </div>
       <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection