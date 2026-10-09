@extends('admin.layouts.app')
@section('title', 'Manage User')
@section('content')
<div id="content" class="app-content">
    <!-- BEGIN breadcrumb -->
        <div class="d-flex align-items-center mb-3">
            <div>
                <h1 class="page-header mb-0">Admin Users</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route(getRolePrefix().'home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Settings</a></li>
                    <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Admin Users</li>
                </ol>
            </div>
            @can('user-create')
                <div class="ms-auto">
                    <a href="{{ route(getRolePrefix().'users.create') }}" class="btn btn-primary px-4"><i class="fa fa-user-plus fa-lg ms-n2 "></i> CREATE NEW ADMIN USER</a>
                </div>
            @endcan
        </div>
    <!-- BEGIN panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading bg-theme-based">
            <h4 class="panel-title" style="text-transform: capitalize;">ADMIN USERS</h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
            </div>
        </div>
        <!-- END panel-heading -->
        @if (\Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-0">
                <strong> Success! </strong> {{ \Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></span>
            </div>
        @endif
        <!-- BEGIN panel-body -->
        <div class="panel-body">
            <table id="data-table-default" width="100%" class="table table-striped table-bordered align-middle text-nowrap">
                <thead>
                    <tr>
                        <th width="1%"></th>
                        <th width="1%" data-orderable="false"></th>
                        <th class="text-nowrap">Name</th>
                        <th class="text-nowrap">Email</th>
                        <th class="text-nowrap">Phone</th>
                        <th class="text-nowrap">Roles</th>
                        <th class="text-nowrap">Created On</th>
                        @can('user-status') 
                        <th class="text-nowrap" width="5%">Status</th>
                        @endcan
                        <th class="text-nowrap" width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $user)
                        <tr class="odd gradeX">
                            <td width="1%" class="fw-bold">{{ ++$i }}</td>
                            <td width="1%" class="with-img">
                                <img src="https://ui-avatars.com/api/?background=random&name={{ $user->name }}" class="rounded h-30px my-n1 mx-n1" />
                            </td>
                            <td><span class="fw-600">{{ $user->name }}</span></td>
                            <td><a class="fw-600" href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                            <td><span class="fw-600">{{ !empty($user->phone) ? $user->phone : 'N/A' }}</span></td>
                            <td>
                                @if (!empty($user->getRoleNames()))
                                    @foreach ($user->getRoleNames() as $v)
                                        <label class="badge bg-success">{{ $v }}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M, Y h:i A') }}</td>
                            @can('user-status') 
                            <td>
                                @if(!$user->hasRole('Superadmin'))
                                    <div class="form-check form-switch">
                                        <input class="form-check-input userstatus" data-id="{{ $user->id }}" type="checkbox" {{ $user->is_status == 1 ? 'checked' : '' }}>
                                    </div>
                                @endif
                            </td>
                            @endcan
                            <td>
                                @if(!$user->hasRole('Superadmin'))
                                    <a class="btn btn-green btn-xs" href="{{ route(getRolePrefix().'users.show', $user->id) }}"><i class="fa-solid fa-list"></i> Show</a>
                                    @can('user-edit')      
                                        <a class="btn btn-primary btn-xs" href="{{ route(getRolePrefix().'users.edit', $user->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                    @endcan
                                    @can('user-delete')      
                                        <form method="POST" action="{{ route(getRolePrefix().'users.destroy', $user->id) }}" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs" onClick="if(confirm('Are you sure want to delete this user')){ return true;} else { return false; }"><i class="fa-solid fa-trash"></i> Delete</button>
                                        </form>
                                    @endcan
                                @endif
                            </td>
                        </tr>
                    @endforeach  
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('custom-javascript')
<script>
  $('.userstatus').change(function () {
      let status = $(this).prop('checked') === true ? 1 : 0;
      let userId = $(this).data('id');
      $.ajax({
          type: "GET",
          dataType: "json",
          url: '{{ route(getRolePrefix().'users.status') }}',
          data: {'status': status, 'user_id': userId},
          success: function (data) {
              toastr.success(data.message);
          }
      });
  });
</script>
@endsection