@extends('master')

@section('content')
    <div class="content-wrapper">
        @include('layouts.break_crumb')

        <!-- Main content -->
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
                            <form method="POST" action="{{ route('student.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Tên học sinh (*)</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder="Nhập tên học sinh">
                                    </div>
                                    <div class="form-group">
                                        <label for="birthday">Ngày sinh (*)</label>
                                        <input type="date" name="birthday" class="form-control" id="birthday">
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Giới tính (*)</label>
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        value="1">
                                                    <label class="form-check-label">Nam</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        value="2">
                                                    <label class="form-check-label">Nữ</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Địa chỉ (*)</label>
                                        <input type="text" name="address" class="form-control" id="address"
                                            placeholder="Nhập dịa chỉ">
                                    </div>
                                    <div class="form-group">
                                        <label for="grade_level">Khối</label>
                                        <select name="grade_level" id="grade_level" class="form-control">
                                            <option value="">Chọn khối</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}">Khối {{ $i }}</option>
                                            @endfor
                                            <option value="13">Khác</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="parent_guardian_name">Người giám hộ (*)</label>
                                        <input type="text" name="parent_guardian_name" class="form-control"
                                            id="parent_guardian_name" placeholder="Nhập người giám hộ">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại (*)</label>
                                        <input type="number" name="phone" class="form-control" id="phone"
                                            placeholder="Nhập số điện thoại">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Nhập email">
                                    </div>
                                    <div class="form-group">
                                        <label for="id_card">Căn cước công dân</label>
                                        <input type="number" name="id_card" class="form-control" id="id_card"
                                            placeholder="Nhập căn cước công dân">
                                    </div>
                                    <div class="form-group">
                                        <label for="id_school">Trường học (*)</label>
                                        <select name="id_school" id="id_school" class="form-control select2bs4">
                                            <option value="">Chọn trường học</option>
                                            @foreach ($schools as $school)
                                                <option value="{{ $school->id }}">
                                                    {{ $school->name }}</option>
                                            @endforeach
                                        </select>
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
