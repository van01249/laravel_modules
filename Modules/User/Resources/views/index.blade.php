@extends('master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('layouts.break_crumb')

        <!-- Main content -->
        <section class="content">
            <div class="card">
                <form action="">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <input type="text" name="keyword" id="keyword" class="form-control"
                                        placeholder="ID, Tên người dùng"
                                        value="{{ isset($dataRequest['keyword']) ? $dataRequest['keyword'] : '' }}">
                                </div>
                                <div class="col-3">
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Email"
                                        value="{{ isset($dataRequest['email']) ? $dataRequest['email'] : '' }}">
                                </div>
                                <div class="col-2">
                                    <input type="submit" class="form-control" value="Tìm kiếm">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /.card-body -->
            </div>
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Tên người dùng</th>
                            <th>Email</th>
                            <th>Admin</th>
                            <th>Ngày tạo</th>
                            <th>Ngày cập nhật</th>
                            <th>Người tạo</th>
                        </tr>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <input type="checkbox" name="is_admin" class="is_admin"
                                        {{ $user->is_admin == 1 ? 'checked' : '' }}
                                        data-href="{{ route('user.active', ['id' => $user->id]) }}">
                                </td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td>{{ $user->user->name }}</td>
                                {{-- <td>
                                    @if ($roles['edit'])
                                        <a class="btn btn-success"
                                            href="{{ route('user.edit', ['user' => $user->id]) }}">Sửa</a>
                                    @endif
                                    @if ($roles['delete'])
                                        <button class="btn btn-danger btn_delete"
                                            data-href="{{ route('user.destroy', ['user' => $user->id]) }}">Xóa</button>
                                    @endif
                                </td> --}}
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>

        {{ $users->links() }}
        <!-- /.content -->
    </div>
    <!-- jsGrid -->
@endsection

@section('cjs')
    <script>
        $('.is_admin').on('change', function() {

            if (confirm('Bạn có chắc chắn muốn cập nhật tài khoản admin?')) {
                let url = $(this).attr('data-href');
                let check = $(this).prop('checked') ? 1 : 0;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        check: check
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.result) {
                            window.location.reload();
                        } else {
                            alert(data.message)
                        }
                    },
                    error: function(error) {
                        console.log(error)
                    }
                })
            }

        })
    </script>
@endsection
