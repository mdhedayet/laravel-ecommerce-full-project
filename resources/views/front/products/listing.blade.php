@extends('layouts.front_layout.front_layout')
@section('contant')
<div class="col-sm-9 padding-right">
    <div class="all_category_items">
        <!--all_category_items-->
        <h2 class="title text-center">{{$CategoryDetails['CategoryDetails']['category_name']}}</h2>
        <div style="margin-bottom: 30px !important;" class="form-inline col-sm-12">
            <span class="float-left">{{$categoryPrductsCount}} Items found </span>
			{{-- <a href="{{url('/')}}">Home</a><span class="devider">/</span><?php echo $CategoryDetails['breadcrumbs'];?> --}}
            <form name="sortProducts" id="sortProducts" style="display:inline; float:right;">
                <input type="hidden" name="url" id="url" value="{{$url}}">
            <select name="sort" id="sort" class="form-control">
                <option value="">Select Sort By</option>
                <option value="product_latest" @if(isset($_GET['sort']) && $_GET['sort']=='product_latest') selected @endif>Latest Products</option>
                <option value="product_name_a_z" @if(isset($_GET['sort']) && $_GET['sort']=='product_name_a_z') selected @endif>Products Name A - Z</option>
                <option value="product_name_z_a" @if(isset($_GET['sort']) && $_GET['sort']=='product_name_z_a') selected @endif>Products Name Z - A</option>
                <option value="product_lowest" @if(isset($_GET['sort']) && $_GET['sort']=='product_lowest') selected @endif>Lowest Price First</option>
                <option value="product_highest" @if(isset($_GET['sort']) && $_GET['sort']=='product_highest') selected @endif>Highest Price First</option>
            </select>
            </form>
        </div>
        <div class="filter_products">
        @include('front.products.ajax_listing')
        </div>


    </div>
    @if(isset($_GET['sort']) && !empty($_GET['sort']))
    {{$categoryPrducts->appends(['sort' => $_GET['sort']])->links()}}
    @else
    {{ $categoryPrducts->links() }}
    @endif
</div>
<!--features_products-->
</div>
@endsection
