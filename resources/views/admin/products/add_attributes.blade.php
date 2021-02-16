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
 @if (Session::get('error_message'))
          <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
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
                        <label for="exampleInputEmail1">Default Price:	&nbsp;</label>${{$productData['product_price']}}
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
                                <input id="size" name="size[]" placeholder="Size" required="" type="text"  value="" style="width: 90px;"/>
                                <input id="sku" name="sku[]" placeholder="SKU" type="text" required="" value="" style="width: 90px;"/>
                                <input id="price" name="price[]" placeholder="Price" required="" type="number"  value="" style="width: 90px;"/>
                                <input id="stock" name="stock[]" placeholder="Stock" required="" type="number"  value="" style="width: 90px;"/>
                                <a href="javascript:void(0);" class="add_button btn btn-primary btn-sm" title="Add field" style="margin-left: 5px !important;margin-top: -4px !important;"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div> 
                  
              </div> 
            </div>

          </div>
          <!-- /.card-body -->
          <div class="card-footer">
           <button type="submit" class="btn btn-primary">Add Attributes</button>
          </div>
        </div>
        </form>
      </div>


     <div class="content ">
      <div class="row mx-1">
        <div class="col-12 ">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Added Product Attributes</h3>
            </div>
            <form action="{{url("admin/edit-attribute/".$productData['id'])}}" method="post">
              @csrf
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Size</th>
                  <th>SKU</th>
                  <th>Price</th>
                  <th>Stock</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $noId=1; ?>
                @foreach ($productData['attributes'] as $attribute)
                <tr>
                  <td>{{$noId++}}
                  <input type="hidden" name="attrId[]" value="{{$attribute['id']}}" required="">
                  </td>
                  <td>{{$attribute['size']}}</td>
                  <td>{{$attribute['sku']}}</td>
                  <td>
                  <input type="number" name="price[]" value="{{$attribute['price']}}" required="">
                  </td>
                  <td>
                  <input type="number" name="stock[]" value="{{$attribute['stock']}}" required="">
                  </td>
                  <td>
                    @if ($attribute['status'] == 1)
                      <a class="updateattributeStatus" id="attribute-{{$attribute['id']}}" attribute_id="{{$attribute['id']}}" style="color:green;" href="javascript:void(0)">Active</a>
                      @else
                      <a class="updateattributeStatus" id="attribute-{{$attribute['id']}}" attribute_id="{{$attribute['id']}}" style="color: red;" href="javascript:void(0)">Inactive</a>
                      @endif
                  </td>
                  <td>
                    <a class="btn btn-danger btn-sm  confirmDelete" name="attribute" nameid="{{$attribute['id']}}" href="javascript:void(0)" title="Delete Attribute"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <div class="card-footer">
           <button type="submit" class="btn btn-primary">Update Attributes</button>
          </div>
            </form>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
       <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection