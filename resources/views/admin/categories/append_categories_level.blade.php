<div class="form-group">
    <label>Select Category Level</label>
    <select name="parent_id" id="parent_id" class="form-control select2" style="width: 100%;">
        <option value="0" {{(isset($categorydata['parent_id']) && $categorydata['parent_id']) == 0 ? 'selected' : ""}}>Main Category</option>
        @if(!empty($getCategories))
            @foreach($getCategories as $category)
                <option value="{{ $category['id'] }}" {{(isset($categorydata['parent_id']) && $categorydata['parent_id'] == $category['id']) ? 'selected' : ""}}
                >{{$category['category_name']}}</option>
                @if(!empty($category['subcategories']))
                    @foreach($category['subcategories'] as $subcategory)
                        <option value="{{$subcategory['id']}}">&nbsp;&raquo; {{$subcategory['category_name']}}</option>
                    @endforeach
                @endif
            @endforeach
        @endif
    </select>
</div>
