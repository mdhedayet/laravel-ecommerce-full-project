<div class="form-group">
    <label>Select Category Lavel</label>
    <select name="parent_id" id="parent_id" class="form-control select2" style="width: 100%;">
        <option value="0" @if(isset($categoryData['parent_id']) && $categoryData['parent_id']==0) selected="selected @endif">Main Category</option>
        @if(!empty($getCategory))
        @foreach ($getCategory as $category)
            <option value="{{$category->id}}" @if(isset($categoryData['parent_id']) && $categoryData['parent_id']==$category->id) selected="selected" @endif>{{$category['category_name']}}</option>
                    @if(!empty($category['subcategories']))
                        @foreach ($category['subcategories'] as $subcategory)
                            <option disabled value="{{$subcategory->id}}" > &raquo;&nbsp;{{$subcategory['category_name']}}</option>
                        @endforeach
                    @endif
        @endforeach
        @endif
    </select>
</div>