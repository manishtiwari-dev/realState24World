@php
    $dash.='-- '; 
    $rowselect = '';
@endphp    
@foreach($subcategories as $subcategory)
    @php
        if(!empty($categoryrow->parent_id)) {
            if($categoryrow->parent_id == $subcategory->id){
                $rowselect = 'selected';
            }
        }
    @endphp
    <option value="{{$subcategory->id}}" {{ $rowselect }} >{{$dash}}{{$subcategory->name}}</option>
    @if(count($subcategory->subcategory))
        @include('admin.category/sub-category-option',['subcategories' => $subcategory->subcategory])
    @endif
@endforeach