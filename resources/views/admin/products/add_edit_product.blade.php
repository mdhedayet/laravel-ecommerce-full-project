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
      <form @if(empty($productData['id'])) action="{{url('admin/add-edit-product')}}" @else action="{{url('admin/add-edit-product/'.$productData['id'])}}" @endif  method="post" enctype="multipart/form-data">
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
                        <label>Select Category<span style="color: red;"> *</span></label>
                        <select name="category_id" id="category_id" class="form-control select2" style="width: 100%;">
                            <option value="">Select</option>
                              @foreach($categories as $section)
                              <optgroup label="{{$section['name']}}">
                                @foreach($section['categories'] as $category )
                                        <option value="{{$category['id']}}" 
                                        @if(!empty($category['subcategories'])) 
                                        disabled 
                                        @endif 
                                        @if(!empty(@old('category_id')) && $category['id']==@old('category_id')) 
                                        selected 
                                        @elseif(!empty($productData['category_id'])&& $productData['category_id']==$category['id']) 
                                        selected=''
                                        @endif
                                        >&nbsp;&nbsp;{{$category['category_name']}}</option>
                                  @foreach($category['subcategories'] as $subcategory )
                                      <option value="{{$subcategory['id']}}" 
                                      @if(!empty(@old('category_id')) && $subcategory['id']==@old('category_id')) 
                                      selected 
                                      @elseif(!empty($productData['category_id'])&& $productData['category_id']==$subcategory['id']) 
                                        selected=''
                                      @endif
                                      >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&nbsp;{{$subcategory['category_name']}}</option>
                                  @endforeach
                                @endforeach
                              </optgroup>
                              @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Name<span style="color: red;"> *</span></label>
                        <input class="form-control" type="text" name="product_name" id="product_name" @if(!empty($productData['product_name'])) value="{{$productData['product_name']}}" @else value="{{old('product_name')}}" @endif placeholder="Enter product name">
                    </div> 

                    
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                        <label>Select Brand</label>
                        <select name="brand_id" id="brand_id" class="form-control select2" style="width: 100%;">
                            <option value="">Select</option>
                            @foreach ($brands as $brand)
                            <option value="{{$brand['id']}}" @if(!empty($productData['brand_id'])&& $productData['brand_id']==$brand['id']) selected='' @endif>{{$brand['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Code<span style="color: red;"> *</span></label>
                        <input class="form-control" type="text" name="product_code" id="product_code" @if(!empty($productData['product_code'])) value="{{$productData['product_code']}}" @else value="{{old('product_code')}}" @endif placeholder="Enter Product Code">
                    </div>
                  </div>
              <div class="col-md-6">
                <div class="form-group">
                        <label for="exampleInputEmail1">Product Price<span style="color: red;"> *</span></label>
                        <input class="form-control" type="number" name="product_price" id="product_price" @if(!empty($productData['product_price'])) value="{{$productData['product_price']}}" @else value="{{old('product_price')}}" @endif placeholder="Enter Product Price">
                    </div> 
                <div class="form-group">
                        <label for="exampleInputEmail1">Product Color<span style="color: red;"> *</span></label>
                        <input class="form-control" type="text" name="product_color" id="product_color" @if(!empty($productData['product_color'])) value="{{$productData['product_color']}}" @else value="{{old('product_color')}}" @endif placeholder="Enter Product Color">
                    </div> 
                     
              </div> 
              <div class="col-md-6">
                  
                  <div class="form-group">
                        <label for="exampleInputEmail1">Product Discount (%)</label>
                        <input class="form-control" type="number" name="product_discount" id="product_discount" @if(!empty($productData['product_discount'])) value="{{$productData['product_discount']}}" @else value="{{old('product_discount')}}" @endif placeholder="Enter Product Discount (1 to 100)">
                    </div> 
                    <div class="form-group">
                    <label for="exampleInputFile">Product Image</label>
                    <label class="float-right" style="color: rgb(216, 104, 0);">Recommended Image Size:( 1040px X 1200 px )</label>
                    <div class="row col-12" style="margin:0; padding:0;">
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputfilenamehere" name="main_image" >
                        <label class="custom-file-label" for="inputfilenamehere">Choose file</label>
                      </div>
                        @if (!empty($productData['main_image']))
                        <input type="hidden" name="current_main_image" value="{{$productData['main_image']}}">
                        <div style="margin-left: 10px;margin-right: 10px;width: 40px;height: 38px;position: relative;overflow: hidden;border-radius: 5px;background-color: #ececec;">
                        <img src="{{asset('images/product_images/large/'.$productData['main_image'])}}" alt="Avatar" style="display: inline;margin: 0 auto;height: 100%; vertical-align: middle;width: auto;">
                        </div>
                        <a class="btn btn-danger" href="{{url('admin/delete-main-image/'.$productData['id'])}}"> Delete Image</a>
                        @endif

                    </div>
                    
                   </div>
                  </div>
              </div> 
              <div class="col-md-6">
                   <div class="form-group">
                        <label for="exampleInputFile">Product Video</label>
                        <div class="row col-12" style="margin:0; padding:0;">
                        <div class="input-group">
                        <div class="custom-file">
                            <input type="file" accept=" video/*" class="custom-file-input" id="inputfilenamehere" name="product_video" >
                            <label class="custom-file-label" for="inputfilenamehere">Choose file</label>
                        </div>
                        @if (!empty($productData['product_video']))
                        <input type="hidden" name="current_product_video" value="{{$productData['product_video']}}">
                        <div style="margin-left: 10px;margin-right: 10px;width: 40px;height: 38px;position: relative;overflow: hidden;border-radius: 5px;background-color: #ececec;">
                        <video style="display: inline;margin: 0 auto;height: 100%; vertical-align: middle;width: auto;">
                          <source src="{{asset('videos/product_videos/'.$productData['product_video'])}}" type="video/mp4"> 
                          <source src="{{asset('videos/product_videos/'.$productData['product_video'])}}" type="video/webm"> 
                          <source src="{{asset('videos/product_videos/'.$productData['product_video'])}}" type="video/ogg"> 
                            </video>
                        </div>
                        <a class="btn btn-danger" href="{{url('admin/delete-product-video/'.$productData['id'])}}"> Delete Video</a>
                        @endif

                    </div>
                    
                   </div>
                  </div>

                  <div class="form-group">
                        <label for="exampleInputEmail1">Product Weight</label>
                        <input class="form-control" type="number" name="product_weight" id="product_weight" @if(!empty($productData['product_weight'])) value="{{$productData['product_weight']}}" @else value="{{old('product_weight')}}" @endif placeholder="Enter Product Weight">
                   </div>
                  
                </div> 

                <div class="col-md-6">

                    
                 
                  
                  <div class="form-group">
                        <label>Select fabric</label>
                        <select name="fabric" id="fabric" class="form-control select2" style="width: 100%;">
                            <option value="" selected="selected">Select</option>
                            @foreach ($fabricArray as $fabric)
                            <option value="{{$fabric}}" @if(!empty($productData['fabric'])&& $productData['fabric']==$fabric) selected='' @endif>{{$fabric}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Select sleeve</label>
                        <select name="sleeve" id="sleeve" class="form-control select2" style="width: 100%;">
                            <option value="">Select</option>
                            @foreach ($sleeveArray as $sleeve)
                            <option value="{{$sleeve}}" @if(!empty($productData['sleeve'])&& $productData['sleeve']==$sleeve) selected='' @endif>{{$sleeve}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> 

                <div class="col-md-6">

                  
                  <div class="form-group">
                        <label>Select fit</label>
                        <select name="fit" id="fit" class="form-control select2" style="width: 100%;">
                            <option value="">Select</option>
                            @foreach ($fitArray as $fit)
                            <option value="{{$fit}}" @if(!empty($productData['fit'])&& $productData['fit']==$fit) selected='' @endif>{{$fit}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Select pattern</label>
                        <select name="pattern" id="pattern" class="form-control select2" style="width: 100%;">
                            <option value="">Select</option>
                            @foreach ($patternArray as $pattern)
                            <option value="{{$pattern}}" @if(!empty($productData['pattern'])&& $productData['pattern']==$pattern) selected='' @endif>{{$pattern}}</option>
                            @endforeach
                        </select>
                    </div>
                    </div> 

                <div class="col-md-6">
                  
                  <div class="form-group">
                        <label>Select occassion</label>
                        <select name="occassion" id="occassion" class="form-control select2" style="width: 100%;">
                            <option value="">Select</option>
                            @foreach ($occassionArray as $occassion)
                            <option value="{{$occassion}}" @if(!empty($productData['occassion'])&& $productData['occassion']==$occassion) selected='' @endif>{{$occassion}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product is featured?</label>
                        <select name="is_featured" id="is_featured" class="form-control select2" style="width: 100%;">
                            <option value="No">Select</option>
                            <option value="No" @if(!empty($productData['is_featured'])&& $productData['is_featured']=="No") selected='' @endif>No</option>
                            <option value="Yes" @if(!empty($productData['is_featured'])&& $productData['is_featured']=="Yes") selected='' @endif>Yes</option>
                        </select>
                    </div>
                    </div> 

                <div class="col-md-6">
                  
                     
                    <div class="form-group">
                    <label for="exampleInputEmail1">Wash Care</label>
                    <textarea class="form-control" name="wash_care" id="wash_care" rows="3" placeholder="Enter Product Wash Care">@if(!empty($productData['wash_care'])){{$productData['wash_care']}}@else{{old('wash_care')}}@endif</textarea>
                  </div>
                    <div class="form-group">
                    <label for="exampleInputEmail1">Product Description<span style="color: red;"> *</span></label>
                    <textarea class="form-control" name="description" id="description" rows="7" placeholder="Enter Product Description">@if(!empty($productData['description'])){{$productData['description']}}@else{{old('description')}}@endif</textarea>
                  </div>
                      </div> 

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Meta Title</label>
                        <input class="form-control" type="text" name="meta_title" id="meta_title" @if(!empty($productData['meta_title'])) value="{{$productData['meta_title']}}" @else value="{{old('meta_title')}}" @endif placeholder="Enter Meta Title">
                    </div> 
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Meta Keywords</label>
                    <textarea class="form-control" name="meta_keywords" id="meta_keywords" rows="3" placeholder="Enter Meta Keywords">@if(!empty($productData['meta_keywords'])){{$productData['meta_keywords']}}@else{{old('meta_keywords')}}@endif</textarea>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputEmail1">Meta Description</label>
                    <textarea class="form-control" name="meta_description" id="meta_description" rows="3" placeholder="Enter Meta Description">@if(!empty($productData['meta_description'])){{$productData['meta_description']}}@else{{old('meta_description')}}@endif</textarea>
                    </div>
                  </div> 
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