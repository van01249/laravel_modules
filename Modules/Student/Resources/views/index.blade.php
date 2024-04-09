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
                                <div class="col-4">
                                    <input type="text" name="keyword" id="keyword" class="form-control"
                                        placeholder="ID, Tên học sinh"
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
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="">Chọn giới tính</option>
                                        <option value="1"
                                            {{ isset($dataRequest['gender']) && $dataRequest['gender'] == 1 ? 'selected' : '' }}>
                                            Nam</option>
                                        <option value="1"
                                            {{ isset($dataRequest['gender']) && $dataRequest['gender'] == 2 ? 'selected' : '' }}>
                                            Nữ</option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <input type="id_card" name="id_card" id="id_card" class="form-control"
                                        placeholder="CCCD"
                                        value="{{ isset($dataRequest['id_card']) ? $dataRequest['id_card'] : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <input type="grade_level" name="grade_level" id="grade_level" class="form-control"
                                        placeholder="Khối"
                                        value="{{ isset($dataRequest['grade_level']) ? $dataRequest['grade_level'] : '' }}">
                                </div>
                                <div class="col-3">
                                    <select name="id_school" id="id_school" class="form-control select2bs4">
                                        <option value="">Chọn trường học</option>
                                        @foreach ($schools as $school)
                                            <option value="{{ $school->id }}"
                                                {{ isset($dataRequest['id_school']) && $school->id == $dataRequest['id_school'] ? 'selected' : '' }}>
                                                {{ $school->name }}
                                            </option>
                                        @endforeach
                                    </select>
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
                            <th>Tên học sinh</th>
                            <th>Ngày sinh</th>
                            <th>Giới tính</th>
                            <th>Khối</th>
                            <th>Địa chỉ</th>
                            <th>Người giám hộ</th>
                            <th>SĐT</th>
                            <th>Email</th>
                            <th>CCCD</th>
                            <th>Trường học</th>
                        </tr>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->birthday }}</td>
                                <td>{{ $student->gender == 1 ? 'Nam' : 'Nữ' }}</td>
                                <td>{{ $student->grade_level }}</td>
                                <td>{{ $student->address }}</td>
                                <td>{{ $student->parent_guardian_name }}</td>
                                <td>{{ $student->phone }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->id_card }}</td>
                                <td>{{ $student->school->name }}</td>
                                <td>
                                    @if ($roles['edit'] == 1)
                                        <a class="btn btn-success"
                                            href="{{ route('student.edit', ['student' => $student->id]) }}">Sửa</a>
                                    @endif
                                    @if ($roles['delete'] == 1)
                                        <button class="btn btn-danger btn_delete"
                                            data-href="{{ route('student.destroy', ['student' => $student->id]) }}">Xóa</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>

        {{ $students->links() }}
        <!-- /.content -->
    </div>
    <!-- jsGrid -->
@endsection
