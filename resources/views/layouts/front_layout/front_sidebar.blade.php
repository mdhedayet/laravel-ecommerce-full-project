<?php
use App\Section;
$sections =Section::sections();
?>
<div class="left-sidebar">
    <h2>Category</h2>
    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
    @foreach ($sections as $section)
    @if (count($section['categories'])>0)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#{{$section['name']}}">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            {{$section['name']}}
                        </a>
                    </h4>
                </div>
                <div id="{{$section['name']}}" class="panel-collapse in">
                    <div class="panel-body">
                        <ul>
                            @foreach ($section['categories'] as $category)
                            <li><a href="{{$category['url']}}"> {{$category['category_name']}}</a></li>
                                @foreach ($category['subcategories'] as $subcategory)
                                <li><a href="{{$subcategory['url']}}"><i class='fa fa-angle-double-right'>&nbsp;</i>{{$subcategory['category_name']}}</a></li>
                                @endforeach
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
    @endif
    @endforeach
    
        
    </div><!--/category-products-->

@if (isset($page_name) && $page_name == 'listing')
<h2>Select Filter</h2>
    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#fabricdd">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            Fabric
                        </a>
                    </h4>
                </div>
                <div id="fabricdd" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach ($fabricArray as $fabric)
                            <input  class="fabric" type="checkbox" name="fabric[]" id="{{$fabric}}" value="{{$fabric}}">&nbsp;{{ucwords($fabric)}}<br>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#sleeveArray">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            Sleeve
                        </a>
                    </h4>
                </div>
                <div id="sleeveArray" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach ($sleeveArray as $sleeve)
                            <input class="sleeve" type="checkbox" name="sleeve[]" id="{{$sleeve}}" value="{{$sleeve}}">&nbsp;{{ucwords($sleeve)}}<br>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#patternArray">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            Pattern
                        </a>
                    </h4>
                </div>
                <div id="patternArray" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach ($patternArray as $pattern)
                            <input class="pattern" type="checkbox" name="pattern[]" id="{{$pattern}}" value="{{$pattern}}">&nbsp;{{ucwords($pattern)}}<br>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#fitArray">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            Fit
                        </a>
                    </h4>
                </div>
                <div id="fitArray" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach ($fitArray as $fit)
                            <input class="fit" type="checkbox" name="fit[]" id="{{$fit}}" value="{{$fit}}">&nbsp;{{ucwords($fit)}}<br>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#occassionArray">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            Occassion
                        </a>
                    </h4>
                </div>
                <div id="occassionArray" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach ($occassionArray as $occassion)
                            <input class="occassion" type="checkbox" name="occassion[]" id="{{$occassion}}" value="{{$occassion}}">&nbsp;{{ucwords($occassion)}}<br>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>
@endif
    

    <div class="brands_products"><!--brands_products-->
        <h2>Brands</h2>
        <div class="brands-name">
            <ul class="nav nav-pills nav-stacked">
                <li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
                <li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
                <li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
                <li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
                <li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
                <li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
                <li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
            </ul>
        </div>
    </div><!--/brands_products-->

    <div class="price-range"><!--price-range-->
        <h2>Price Range</h2>
        <div class="well text-center">
                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
        </div>
    </div><!--/price-range-->

    <div class="shipping text-center"><!--shipping-->
        <img src="{{asset('images/front_images/home/shipping.jpg')}}" alt="" />
    </div><!--/shipping-->

</div>