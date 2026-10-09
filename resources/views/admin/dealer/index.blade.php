@extends('admin.layouts.app')
@section('title', 'Manage User')
@section('content')
    <div id="content" class="app-content">
        <!-- BEGIN breadcrumb -->
        <div class="d-flex align-items-center mb-3">
            <div>
                <h1 class="page-header mb-0">Dealer's List</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route(getRolePrefix() . 'home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Dealer</a></li>
                    <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Dealer's List</li>
                </ol>
            </div>
            @can('dealer-create')
                <div class="ms-auto">
                    <a href="{{ route(getRolePrefix() . 'dealer.create') }}" class="btn btn-primary px-4"><i
                            class="fa fa-user-plus fa-lg ms-n2 "></i> CREATE NEW DEALER</a>
                </div>
            @endcan
        </div>
        <!-- BEGIN panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading bg-theme-based">
                <h4 class="panel-title" style="text-transform: capitalize;">DEALER'S LIST</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i
                            class="fa fa-redo"></i></a>
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
                <table id="data-table-default" width="100%"
                    class="table table-striped table-bordered align-middle text-nowrap">
                    <thead>
                        <tr>
                            <th width="1%"></th>
                            <th width="1%" data-orderable="false"></th>
                            <th class="text-nowrap" width="12%">Code</th>
                            <th class="text-nowrap">Name</th>
                            <th class="text-nowrap">Company</th>
                            <th class="text-nowrap">Email</th>
                            <th class="text-nowrap">Phone</th>
                            <th class="text-nowrap" width="1%">Verified</th>
                            <th class="text-nowrap" width="1%">Status</th>

                            <th class="text-nowrap">Created On</th>
                            <th class="text-nowrap" width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $user)
                            <tr class="odd gradeX">
                                <td width="1%" class="fw-bold">{{ ++$i }}</td>
                                <td width="1%" class="with-img">
                                    @if (empty($user->profile_photo))
                                        <img src="https://ui-avatars.com/api/?background=random&name={{ $user->name }}"
                                            class="rounded h-30px my-n1 mx-n1" />
                                    @else
                                        <img src="{{ asset('uploads/dealer/' . $user->profile_photo . '') }}"
                                            class="rounded h-30px my-n1 mx-n1" />
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route(getRolePrefix() . 'dealer.show', $user->id) }}"><span class="fw-600"
                                            id="uniquecode">{{ $user->unique_code }}</span></a>
                                    <i class="fa fa-clone" style="color: #003fcf; cursor: pointer;" id="copycode"></i>
                                </td>
                                <td><span class="fw-600">{{ $user->name }}</span></td>
                                <td><span class="fw-600">{{ $user->company_name }}</span></td>
                                <td><a class="fw-600" href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                <td><span class="fw-600">{{ !empty($user->phone) ? $user->phone : 'N/A' }}</span></td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input is_verified" data-id="{{ $user->id }}"
                                            type="checkbox" {{ $user->is_verified == 1 ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input is_status" data-id="{{ $user->id }}"
                                            type="checkbox" {{ $user->is_status == 1 ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M, Y h:i A') }}</td>

                                <td>
                                    <a class="btn btn-green btn-xs"
                                        href="{{ route(getRolePrefix() . 'dealer.show', $user->id) }}"><i
                                            class="fa-solid fa-list"></i> Show</a>
                                    @can('dealer-edit')
                                        <a class="btn btn-primary btn-xs"
                                            href="{{ route(getRolePrefix() . 'dealer.edit', $user->id) }}"><i
                                                class="fa-solid fa-pen-to-square"></i> Edit</a>
                                    @endcan
                                    @can('dealer-delete')
                                        <form method="POST"
                                            action="{{ route(getRolePrefix() . 'dealer.destroy', $user->id) }}"
                                            style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs"
                                                onClick="if(confirm('Are you sure want to delete this user')){ return true;} else { return false; }"><i
                                                    class="fa-solid fa-trash"></i> Delete</button>
                                        </form>
                                    @endcan
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
        document.getElementById("copycode").addEventListener("click", function() {
            const text = document.getElementById("uniquecode").innerText;
            navigator.clipboard.writeText(text).then(function() {
                toastr.success("Dealer ID copied: " + text);
            }, function(err) {
                toastr.error("Failed to copy: " + err);
            });
        });


        $('.is_verified').change(function() {
            let status = $(this).prop('checked') === true ? 1 : 0;
            let dealer_id = $(this).data('id');
            $.ajax({
                type: "POST",
                dataType: "json",
                url: '{{ route(getRolePrefix() . 'dealer.is_verified') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'is_verified': status,
                    'dealer_id': dealer_id
                },
                success: function(data) {
                    toastr.success(data.message);
                },
                error: function(xhr) {
                    toastr.error('Something went wrong!');
                }
            });
        });


        $('.is_status').change(function() {
            let status = $(this).prop('checked') === true ? 1 : 0;
            let dealer_id = $(this).data('id');
            $.ajax({
                type: "POST",
                dataType: "json",
                url: '{{ route(getRolePrefix() . 'dealer.is_status') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'is_status': status,
                    'dealer_id': dealer_id
                },
                success: function(data) {
                    toastr.success(data.message);
                },
                error: function(xhr) {
                    toastr.error('Something went wrong!');
                }
            });
        });
    </script>
@endsection
