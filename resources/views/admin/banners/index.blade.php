@extends('admin.layouts.app')
@section('content')
<style>
  .heading-bar {
    position: relative;
    display: inline-block;
    margin: 0px 19px 13px -18px;
    padding: 7px;
    background-color: #fff;
    color: #000000;
    border-top-right-radius: 30px;
    border-bottom-right-radius: 30px;
  &:before {
    position: absolute;
    top: 0;
    left: -100vw;
    height: 100%;
    width: 100vw;
    content: "";
    background-color: var(--heading-bar-color);
  }
}
</style>
<div id="content" class="app-content">
    <div class="d-flex align-items-center mb-3">
        <div>
            <h1 class="page-header mb-0">Banners</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route(getRolePrefix().'home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Banner</a></li>
                <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Banner List</li>
            </ol>
        </div>
        @can('banner-create')
            <div class="ms-auto">
                <a href="{{ route(getRolePrefix().'banners.create') }}" class="btn btn-primary px-4"><i class="fa fa-plus fa-lg ms-n2 "></i> ADD NEW BANNER</a>
            </div>
        @endcan
    </div>
    <div class="row mb-3">
      @if (!empty($onebanners) && count($onebanners) > 0)
        <div class="heading-bar">
          <span style="font-size: 16px; font-weight: 600;">Banner</span>
        </div>
        @foreach ($onebanners as $onebann)
          <div class="col-xl-4 banner-div">
            <div class="banner-area">
              <a href="#"><img src="{{asset('uploads/banner/'.$onebann->image.'')}}"></a>
              <div class="pic_title" style="background: #fff;padding: 10px;">
                <div class="col-xl-12 row">
                  <div class="col-xl-11">
                    <div class="banner_title" style="font-weight: bold;"> {{ $onebann->title }} </div>
                  </div>
                  @can('banner-status')
                  <div class="col-xl-1" style="text-align: end;"> 
                    <div class="form-check form-switch">
                      <input class="form-check-input statusbanner" data-id="{{ $onebann->id }}" type="checkbox" {{ $onebann->status==1 ? 'checked': '' }}>
                    </div> 
                  </div>
                  @endcan
                </div>  
              </div>
              @can('banner-delete')
              <a class="remove-banner" style="display: inline;" href="{{ route(getRolePrefix().'banners.delete', $onebann->id) }}" onClick="if(confirm('Are you sure want to delete this banner')){ return true;} else { return false; }"><i class="fas fa-trash"></i></a>
              @endcan
              @can('banner-edit')
              <a class="edit-banner" href="{{ route(getRolePrefix().'banners.edit', $onebann->id) }}" style="display: inline;"><i class="fas fa-edit"></i></a>
              @endcan
            </div>
          </div>
        @endforeach
      @endif

    @if (!empty($twobanners) && count($twobanners) > 0)
        <div class="heading-bar">
          <span style="font-size: 16px; font-weight: 600;">Home Section - 1</span>
        </div>
        @foreach ($twobanners as $twobann)
          <div class="col-xl-3 banner-div">
            <div class="banner-area">
              <a href="#"><img src="{{asset('uploads/banner/'.$twobann->image.'')}}"></a>
              <div class="pic_title" style="background: #fff;padding: 10px;">
                <div class="col-xl-12 row">
                  <div class="col-xl-10">
                    <div class="banner_title" style="font-weight: bold;"> {{ $twobann->title }} </div>
                  </div>
                  @can('banner-status')
                  <div class="col-xl-2" style="text-align: end;"> 
                    <div class="form-check form-switch">
                      <input class="form-check-input statusbanner" data-id="{{ $twobann->id }}" type="checkbox" {{ $twobann->status==1 ? 'checked': '' }}>
                    </div> 
                  </div>
                  @endcan
                </div>  
              </div>
              @can('banner-delete')
              <a class="remove-banner" style="display: inline;" href="{{ route(getRolePrefix().'banners.delete', $twobann->id) }}" onClick="if(confirm('Are you sure want to delete this banner')){ return true;} else { return false; }"><i class="fas fa-trash"></i></a>
              @endcan
              @can('banner-edit')
              <a class="edit-banner" href="{{ route('admin.banners.edit', $twobann->id) }}" style="display: inline;"><i class="fas fa-edit"></i></a>
              @endcan
            </div>
          </div>
        @endforeach
      @endif

      @if (!empty($threebanners) && count($threebanners) > 0)
        <div class="heading-bar">
          <span style="font-size: 16px; font-weight: 600;">Home Section - 2</span>
        </div>
        @foreach ($threebanners as $threebann)
          <div class="col-xl-3 banner-div">
            <div class="banner-area">
              <a href="#"><img src="{{asset('uploads/banner/'.$threebann->image.'')}}"></a>
              <div class="pic_title" style="background: #fff;padding: 10px;">
                <div class="col-xl-12 row">
                  <div class="col-xl-10">
                    <div class="banner_title" style="font-weight: bold;"> {{ $threebann->title }} </div>
                  </div>
                  @can('banner-status')
                  <div class="col-xl-2" style="text-align: end;"> 
                    <div class="form-check form-switch">
                      <input class="form-check-input statusbanner" data-id="{{ $threebann->id }}" type="checkbox" {{ $threebann->status==1 ? 'checked': '' }}>
                    </div> 
                  </div>
                  @endcan
                </div>  
              </div>
              @can('banner-delete')
              <a class="remove-banner" style="display: inline;" href="{{ route(getRolePrefix().'banners.delete', $threebann->id) }}" onClick="if(confirm('Are you sure want to delete this banner')){ return true;} else { return false; }"><i class="fas fa-trash"></i></a>
              @endcan
              @can('banner-edit')
              <a class="edit-banner" href="{{ route('admin.banners.edit', $threebann->id) }}" style="display: inline;"><i class="fas fa-edit"></i></a>
              @endcan
            </div>
          </div>
        @endforeach
      @endif

    @if (!empty($fourbanners) && count($fourbanners) > 0)
        <div class="heading-bar">
          <span style="font-size: 16px; font-weight: 600;">Home Section - 3</span>
        </div>
        @foreach ($fourbanners as $fourbann)
          <div class="col-xl-3 banner-div">
            <div class="banner-area">
              <a href="#"><img src="{{ asset('uploads/banner/'.$fourbann->image.'') }}"></a>
              <div class="pic_title" style="background: #fff;padding: 10px;">
                <div class="col-xl-12 row">
                  <div class="col-xl-10">
                    <div class="banner_title" style="font-weight: bold;"> {{ $fourbann->title }} </div>
                  </div>
                  @can('banner-status')
                  <div class="col-xl-2" style="text-align: end;"> 
                    <div class="form-check form-switch">
                      <input class="form-check-input statusbanner" data-id="{{ $fourbann->id }}" type="checkbox" {{ $fourbann->status==1 ? 'checked': '' }}>
                    </div> 
                  </div>
                  @endcan
                </div>  
              </div>
              @can('banner-delete')
              <a class="remove-banner" style="display: inline;" href="{{ route(getRolePrefix().'banners.delete', $fourbann->id) }}" onClick="if(confirm('Are you sure want to delete this banner')){ return true;} else { return false; }"><i class="fas fa-trash"></i></a>
              @endcan
              @can('banner-edit')
              <a class="edit-banner" href="{{ route(getRolePrefix().'banners.edit', $fourbann->id) }}" style="display: inline;"><i class="fas fa-edit"></i></a>
              @endcan
            </div>
          </div>
        @endforeach
      @endif
  </div>
</div>
@endsection
@section('custom-javascript')
<script>
  $('.statusbanner').change(function () {
      let status = $(this).prop('checked') === true ? 1 : 0;
      let bannerId = $(this).data('id');
      $.ajax({
          type: "POST",
          dataType: "json",
          url: '{{ route(getRolePrefix().'banners.status') }}',
          data: {
              '_token': '{{ csrf_token() }}',
              'status': status,
              'banner_id': bannerId
          },
          success: function (data) {
              toastr.success(data.message);
          },
          error: function (xhr) {
              toastr.error('Something went wrong!');
          }
      });
  });
</script>
@endsection