<?php $dash.='-- '; ?>
@foreach($subcategories as $keys => $subcategory)
    <tr>
        <td class="fw-bold text-dark">{{ $parentKey }}.{{ ++$i }} </td>
        <td class="with-img">
            @if(empty($subcategory->thumbnail))
                <img src="{{ asset('uploads/no-image.png') }}" class="rounded h-40px my-n1 mx-n1"/>
            @else
                <img src="{{ asset('uploads/category/'.$subcategory->thumbnail.'') }}" class="rounded h-40px my-n1 mx-n1"/>
            @endif
        </td>
        <td><b>{{$dash}}</b>{{$subcategory->name}}</td>
        <td>{{$subcategory->slug}}</td>
        <td>{{$subcategory->parent->name}}</td>
        <td>
            <div class="form-check form-switch">
                <input class="form-check-input statuscategory" data-id="{{ $subcategory->id }}"
                    type="checkbox" {{ $subcategory->status == 1 ? 'checked' : '' }}>
            </div>
        </td>
        <td>
            <a class="btn btn-white btn-sm btn-circle me-1 mb-1" href="{{ route(getRolePrefix().'category.edit', $subcategory->id) }}"><i class="fa fa-edit"></i> Edit</a>
            <a href="{{ route(getRolePrefix().'category.delete', $subcategory->id) }}" class="btn btn-danger btn-sm btn-circle me-1 mb-1" style="background-color: #9a1515;"><i class="fa fa-trash"></i>&nbsp;Delete</a>
        </td>
    </tr>
    @if(count($subcategory->subcategory))
        @include('admin.category.sub-category-list',['subcategories' => $subcategory->subcategory])
    @endif
@endforeach