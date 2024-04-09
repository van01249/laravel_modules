<?php

namespace Modules\StudentBook\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Book\Entities\Book;
use Modules\Student\Entities\Student;
use Modules\StudentBook\Entities\StudentBook;
use Modules\StudentBook\Http\Requests\StudentBookRequest;

class StudentBookController extends Controller
{
    protected $studentBooks;
    protected $students;
    protected $books;

    public function __construct(StudentBook $studentBook, Book $book, Student $student)
    {
        $this->studentBooks = $studentBook;
        $this->students = $student;
        $this->books = $book;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        if (Auth::user()->admin == 1 || Auth::user()->checkRole(5)) {
            $roles = [
                'edit' => Auth::user()->admin == 1 || Auth::user()->checkRole(5)->pivot->edit == 1 ? 1 : 0,
                'delete' => Auth::user()->admin == 1 || Auth::user()->checkRole(5)->pivot->delete == 1 ? 1 : 0,
            ];

            $title = 'Danh sách mượn sách';

            $students = $this->students->select(['id', 'name'])->get();
            $books = $this->books->select(['id', 'title'])->get();

            $dataRequest = $request->all();

            $studentBooks = $this->studentBooks->orderBy('id', 'DESC');

            if (isset($request->id_student) && $id_student = $request->id_student) {
                $studentBooks = $studentBooks->where('id_student', $id_student);
            }

            if (isset($request->id_book) && $id_book = $request->id_book) {
                $studentBooks = $studentBooks->where('id_book', $id_book);
            }

            if (isset($request->checkout_date) && $checkout_date = $request->checkout_date) {
                $studentBooks = $studentBooks->where('checkout_date', $checkout_date);
            }

            if (isset($request->return_date) && $return_date = $request->return_date) {
                $studentBooks = $studentBooks->where('return_date', $return_date);
            }

            $studentBooks = $studentBooks->paginate(10);

            return view('studentbook::index', compact('title', 'students', 'books', 'studentBooks', 'roles', 'dataRequest'));
        }

        return redirect()->route('notify');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $checkRole = Auth::user()->checkRole(5);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->add == 1) {
            $title = "Thêm thông tin mượn sách";
            $students = $this->students->select(['id', 'name'])->orderBy('id', 'DESC')->get();
            $books = $this->books->select(['id', 'title', 'quantity', 'quantity_lent'])->where('available', 1)->orderBy('id', 'ASC')->get();

            return view('studentbook::create', compact('title', 'students', 'books'));
        }

        return redirect()->route('notify');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StudentBookRequest $request)
    {
        $checkRole = Auth::user()->checkRole(5);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->add == 1) {
            $insert = $this->studentBooks->insert([
                'id_book' => $request->id_book,
                'id_student' => $request->id_student,
                'checkout_date' => $request->checkout_date,
                'return_date' => $request->return_date,
            ]);

            if ($insert) {
                $book = $this->books->find($request->id_book);
                $book->quantity_lent = $book->quantity_lent + 1;
                $book->save();
            }
            return redirect()->route('studentBook.index');
        }

        return redirect()->route('notify');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('studentbook::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $checkRole = Auth::user()->checkRole(5);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->edit == 1) {
            $studentBook = $this->studentBooks->find($id);

            if ($studentBook) {
                $title = "Thêm thông tin mượn sách";
                $students = $this->students->select(['id', 'name'])->orderBy('id', 'DESC')->get();
                $books = $this->books->select(['id', 'title', 'quantity', 'quantity_lent'])->where('available', 1)->orderBy('id', 'ASC')->get();

                return view('studentbook::edit', compact('title', 'students', 'books', 'studentBook'));
            }
        }

        return redirect()->route('notify');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(StudentBookRequest $request, $id)
    {
        $checkRole = Auth::user()->checkRole(5);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->edit == 1) {
            $studentBook = $this->studentBooks->find($id);

            $studentBook->id_book = $request->id_book;
            $studentBook->id_student = $request->id_student;
            $studentBook->checkout_date = $request->checkout_date;
            $studentBook->return_date = $request->return_date;

            $update = $studentBook->save();
            if ($update) {
                $bookOld = $this->books->find($studentBook->id_book);
                $bookOld->quantity_lent = $bookOld->quantity_lent - 1;
                $bookOld->save();

                $bookNew = $this->books->find($request->id_book);
                $bookNew->quantity_lent = $bookNew->quantity_lent + 1;
                $bookNew->save();
            }
            return redirect()->route('studentBook.index');
        }

        return redirect()->route('notify');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $checkRole = Auth::user()->checkRole(5);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->delete == 1) {
            $this->studentBooks->where('id', $id)->delete();

            return response()->json([
                'result' => true,
                'message' => 'Xóa thành công'
            ]);
        }

        return response()->json([
            'result' => false,
            'message' => 'Không có quyền xóa'
        ]);
    }

    public function active($id, Request $request)
    {
        $checkRole = Auth::user()->checkRole(5);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->edit == 1) {
            $studentBook = $this->studentBooks->find($id);
            $studentBook->is_back = $request->check;
            $studentBook->returned_date = Carbon::now();
            $studentBook->save();

            return response()->json([
                'result' => true,
                'message' => 'Cập nhật thành công'
            ]);
        }

        return response()->json([
            'result' => false,
            'message' => 'Không có quyền cập nhật'
        ]);
    }
}
