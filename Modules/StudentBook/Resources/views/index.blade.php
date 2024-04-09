@extends('master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('layouts.break_crumb')

        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card">
                    <form action="">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="id_student">Học sinh</label>
                                        <select name="id_student" id="id_student" class="form-control select2bs4">
                                            <option value="">Chọn học sinh</option>
                                            @foreach ($students as $student)
                                                <option value="{{ $student->id }}"
                                                    {{ isset($dataRequest['id_student']) && $student->id == $dataRequest['id_student'] ? 'selected' : '' }}>
                                                    {{ $student->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="id_book">Sách</label>
                                        <select name="id_book" id="id_book" class="form-control select2bs4">
                                            <option value="">Chọn sách</option>
                                            @foreach ($books as $book)
                                                <option value="{{ $book->id }}"
                                                    {{ isset($dataRequest['id_book']) && $student->id == $dataRequest['id_book'] ? 'selected' : '' }}>
                                                    {{ $book->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="checkout_date">Ngày mượn</label>
                                        <input type="date" name="checkout_date" id="checkout_date" class="form-control"
                                            value="{{ isset($dataRequest['checkout_date']) ? $dataRequest['checkout_date'] : '' }}">
                                    </div>
                                    <div class="col-3">
                                        <label for="return_date">Ngày trả</label>
                                        <input type="date" name="return_date" id="return_date" class="form-control"
                                            value="{{ isset($dataRequest['return_date']) ? $dataRequest['return_date'] : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-2">
                                        <input type="submit" class="form-control" value="Tìm kiếm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- /.card-body -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table>
                        <tr>
                            <th>ID User</th>
                            <th>Người mượn</th>
                            <th>ID sách</th>
                            <th>Sách</th>
                            <th>Ngày mượn</th>
                            <th>Ngày hẹn trả</th>
                            <th>Đã trả</th>
                            <th>Ngày trả</th>
                        </tr>
                        @foreach ($studentBooks as $studentBook)
                            <tr>
                                <td>{{ $studentBook->id_student }}</td>
                                <td>{{ $studentBook->student->name }}</td>
                                <td>{{ $studentBook->id_book }}</td>
                                <td>{{ $studentBook->book->title }}</td>
                                <td>{{ $studentBook->checkout_date }}</td>
                                <td>{{ $studentBook->return_date }}</td>
                                <td>
                                    <input type="checkbox"
                                        data-href="{{ route('studentBook.active', ['id' => $studentBook->id]) }}"
                                        class="is_back" {{ $studentBook->is_back == 1 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $studentBook->is_back == 1 ? $studentBook->returned_date : '' }}
                                </td>
                                <td>
                                    @if ($roles['edit'] == 1)
                                        <a class="btn btn-success"
                                            href="{{ route('studentBook.edit', ['studentBook' => $studentBook->id]) }}">Sửa</a>
                                    @endif
                                    @if ($roles['delete'] == 1)
                                        <button class="btn btn-danger btn_delete"
                                            data-href="{{ route('studentBook.destroy', ['studentBook' => $studentBook->id]) }}">Xóa</button>
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
        <!-- /.content -->

        {{ $studentBooks->links() }}
    </div>
    <!-- jsGrid -->
@endsection

@section('cjs')
    <script>
        $(function() {
            $('.is_back').on('change', function() {
                if (confirm('Bạn có chắc chắn muốn cập nhật không?')) {
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
                                alert(data.message);
                            }
                        },
                        error: function(error) {
                            console.log(error)
                        }
                    })
                }
            })
        })
    </script>
@endsection
