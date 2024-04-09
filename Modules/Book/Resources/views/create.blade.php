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
                            <form method="POST" action="{{ route('book.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Tên sách (*)</label>
                                        <input type="text" name="title" class="form-control" id="title"
                                            placeholder="Nhập tên sách">
                                    </div>
                                    <div class="form-group">
                                        <label for="author">Tác giả (*)</label>
                                        <input type="text" name="author" class="form-control" id="author"
                                            placeholder="Nhập tác giả">
                                    </div>
                                    <div class="form-group">
                                        <label for="genre">Thể loại (*)</label>
                                        <input type="text" name="genre" class="form-control" id="genre"
                                            placeholder="Nhập thể loại">
                                    </div>
                                    <div class="form-group">
                                        <label for="publisher">Nhà xuất bản (*)</label>
                                        <input type="text" name="publisher" class="form-control" id="publisher"
                                            placeholder="Nhập nhà xuất bản">
                                    </div>
                                    <div class="form-group">
                                        <label for="publish_date">Ngày xuất bản (*)</label>
                                        <input type="date" name="publish_date" class="form-control" id="publish_date">
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Số lượng (*)</label>
                                        <input type="number" name="quantity" class="form-control" id="quantity">
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="available" class="custom-control-input"
                                                class="available" id="available">
                                            <label class="custom-control-label" for="available">Có sẵn</label>
                                        </div>
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
