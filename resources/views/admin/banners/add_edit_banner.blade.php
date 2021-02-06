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
      <form @if(empty($banner['id'])) action="{{url('admin/add-edit-banner')}}" @else action="{{url('admin/add-edit-banner/'.$banner['id'])}}" @endif  method="post" enctype="multipart/form-data">
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
                    <label for="exampleInputEmail1">Title</label>
                  <input class="form-control" type="text" name="title" id="title" @if(!empty($banner['title'])) value="{{$banner['title']}}" @else value="{{old('title')}}" @endif placeholder="Enter banner title">
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                  <textarea class="form-control" rows="5" name="description" id="description" placeholder="Enter Banner Description">@if(!empty($banner['description'])){{$banner['description']}}@else{{old('description')}}@endif</textarea>
                </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputFile">Image</label>
                    <div class="row col-12" style="margin:0; padding:0;">
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputfilenamehere" name="image" >
                        <label class="custom-file-label" for="inputfilenamehere">Choose file</label>
                      </div>
                        @if (!empty($banner['image']))
                        <input type="hidden" name="current_image" value="{{$banner['image']}}">
                        <div style="margin-left: 10px;margin-right: 10px;width: 40px;height: 38px;position: relative;overflow: hidden;border-radius: 5px;background-color: #ececec;">
                        <img src="{{asset('images/banner_images/'.$banner['image'])}}" alt="Avatar" style="display: inline;margin: 0 auto;height: 100%; vertical-align: middle;width: auto;">
                        </div>
                        <a class="btn btn-danger" href="{{url('admin/delete-banner-image/'.$banner['id'])}}"> Delete Image</a>
                        @endif

                    </div>
                    
                   </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Link</label>
                  <input class="form-control" type="text" name="link" id="link" @if(!empty($banner['link'])) value="{{$banner['link']}}" @else value="{{old('link')}}" @endif placeholder="Enter banner link">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Alt</label>
                  <input class="form-control" type="text" name="alt" id="alt" @if(!empty($banner['alt'])) value="{{$banner['alt']}}" @else value="{{old('alt')}}" @endif placeholder="Enter banner alt">
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