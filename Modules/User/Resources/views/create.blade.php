@extends('master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('layouts.break_crumb')
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <!-- /.card-header -->
                            <!-- form start -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('user.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Tên người dùng (*)</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder="Nhập tên người dùng">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email (*)</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Nhập email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password (*)</label>
                                        <input type="password" name="password" class="form-control" id="password"
                                            placeholder="Nhập password">
                                        <input type="checkbox" name="change_pass" class="custom-control-input"
                                            id="change_pass" style="display: none" checked>
                                    </div>
                                    <div class="form-group">
                                        <label for="re_password">Re-Password (*)</label>
                                        <input type="password" name="re_password" class="form-control" id="re_password"
                                            placeholder="Nhập lại passowrd">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="is_admin" class="custom-control-input"
                                                id="is_admin">
                                            <label class="custom-control-label" for="is_admin">Admin</label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0 roles" style="display: none">
                                        <label>Phân quyền Admin</label>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Quản lý</th>
                                                    <th scope="col">Thêm</th>
                                                    <th scope="col">Sửa</th>
                                                    <th scope="col">Xóa</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($roles as $key => $role)
                                                    <tr class="role_tr">
                                                        <td>{{ $role->name }}</td>
                                                        <td>
                                                            <input type="checkbox" name="roles[{{ $role->id }}][add]"
                                                                class="show">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="roles[{{ $role->id }}][edit]"
                                                                class="show">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="roles[{{ $role->id }}][delete]"
                                                                class="show">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
@section('cjs')
    <script>
        $(function() {
            $('#is_admin').on('change', function() {
                if ($(this).prop('checked')) {
                    $('.roles').show();
                } else {
                    $('.roles').hide();
                }
            });
        });
    </script>
@endsection
