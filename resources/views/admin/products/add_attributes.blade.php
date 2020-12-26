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
 
        <!-- SELECT2 EXAMPLE -->
      <form method="post" action="{{url("admin/add-edit-attribute/".$productData['id'])}}">
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
                        <label for="exampleInputEmail1">Product Name:	&nbsp;</label>{{$productData['product_name']}}
                    </div> 
                  <div class="form-group">
                        <label for="exampleInputEmail1">Product Code:	&nbsp;</label>{{$productData['product_code']}}
                    </div> 
                  <div class="form-group">
                        <label for="exampleInputEmail1">Product Color:	&nbsp;</label>{{$productData['product_color']}}
                    </div> 
                  <div class="form-group">
                        <label for="exampleInputEmail1">Product Price:	&nbsp;</label>{{$productData['product_price']}}
                    </div> 
              </div> 
              <div class="col-md-6">
                  <div class="form-group">
                        <img src="{{asset('images/product_images/medium/'.$productData['main_image'])}}" style="width: 150px;">
                    </div> 
                  
              </div> 
              <div class="col-md-6">
                  <div class="form-group">
                        <div class="field_wrapper">
                            <div>
                                <input id="size" name="size[]" placeholder="Size" type="text"  value="" style="width: 90px;"/>
                                <input id="sku" name="sku[]" placeholder="SKU" type="text"  value="" style="width: 90px;"/>
                                <input id="price" name="price[]" placeholder="Price" type="text"  value="" style="width: 90px;"/>
                                <input id="stock" name="stock[]" placeholder="Stock" type="text"  value="" style="width: 90px;"/>
                                <a href="javascript:void(0);" class="add_button btn btn-primary btn-sm" title="Add field" style="margin-left: 5px !important;margin-top: -4px !important;"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
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