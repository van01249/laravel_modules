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
                                <div class="col-5">
                                    <input type="text" name="keyword" id="keyword" class="form-control"
                                        placeholder="ID, Tên trường"
                                        value="{{ isset($dataRequest['keyword']) ? $dataRequest['keyword'] : '' }}">
                                </div>
                                <div class="col-2">
                                    <input type="number" name="phone" id="phone" class="form-control"
                                        placeholder="Số điện thoại"
                                        value="{{ isset($dataRequest['phone']) ? $dataRequest['phone'] : '' }}">
                                </div>
                                <div class="col-2">
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
                            <th>Tên trường học</th>
                            <th>Địa chỉ</th>
                            <th>Mô tả</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                        @foreach ($schools as $school)
                            <tr>
                                <td>{{ $school->id }}</td>
                                <td>{{ $school->name }}</td>
                                <td>{{ $school->address }}</td>
                                <td>{{ $school->descriptions }}</td>
                                <td>{{ $school->phone }}</td>
                                <td>{{ $school->email }}</td>
                                <td>
                                    @if ($roles['edit'])
                                        <a class="btn btn-success"
                                            href="{{ route('school.edit', ['school' => $school->id]) }}">Sửa</a>
                                    @endif

                                    @if ($roles['delete'])
                                        <button class="btn btn-danger btn_delete"
                                            data-href="{{ route('school.destroy', ['school' => $school->id]) }}">Xóa</button>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </table>

                </div>
                <!-- /.card-body -->
            </div>
            {{ $schools->links() }}
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- jsGrid -->
@endsection
