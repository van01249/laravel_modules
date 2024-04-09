<?php

namespace Modules\Book\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Book\Entities\Book;
use Modules\Book\Http\Requests\BookRequest;

class BookController extends Controller
{
    protected $books;

    public function __construct(Book $book)
    {
        $this->books = $book;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $checkRole = Auth::user()->checkRole(4);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole) {

            $roles = [
                'edit' => Auth::user()->admin == 1 || Auth::user()->checkRole(4)->pivot->edit == 1 ? 1 : 0,
                'delete' => Auth::user()->admin == 1 || Auth::user()->checkRole(4)->pivot->delete == 1 ? 1 : 0,
            ];

            $title = "Danh sách Sách";
            $dataRequest = $request->all();
            $books = $this->books->orderBy('id', 'DESC');
            if ($request->keyword && $keyword = $request->keyword) {
                $books = $books->where('id', '=', $keyword)->orWhere('title', 'LIKE', "%{$keyword}%");
            }

            if ($request->author && $author = $request->author) {
                $books = $books->where('author', 'LIKE', '%' . $author . '%');
            }

            if ($request->genre && $genre = $request->genre) {
                $books = $books->where('genre', 'LIKE', '%' . $genre . '%');
            }

            if ($request->publisher && $publisher = $request->publisher) {
                $books = $books->where('publisher', 'LIKE', '%' . $publisher . '%');
            }

            if ($request->ISBN && $ISBN = $request->ISBN) {
                $books = $books->where('ISBN', $ISBN);
            }

            $books = $books->paginate(10);

            return view('book::index', compact('books', 'title', 'dataRequest', 'roles'));
        }

        return redirect()->route('notify');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $checkRole = Auth::user()->checkRole(4);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->add == 1) {
            $title = 'Thêm thông tin sách';

            return view('book::create', compact('title'));
        }

        return redirect()->route('notify');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(BookRequest $request)
    {
        $checkRole = Auth::user()->checkRole(4);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->add == 1) {
            $this->books->create([
                'title' => $request->title,
                'author' => $request->author,
                'genre' => $request->genre,
                'publisher' => $request->publisher,
                'publish_date' => $request->publish_date,
                'quantity' => $request->quantity,
                'available' => isset($request->available) ? 1 : 0,
            ]);

            return redirect()->route('book.index');
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
        return view('book::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $checkRole = Auth::user()->checkRole(4);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->edit == 1) {
            $book = $this->books->find($id);
            if ($book) {
                $title = 'Cập nhật thông tin Sách';

                return view('book::edit', compact('title', 'book'));
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
    public function update(BookRequest $request, $id)
    {
        $checkRole = Auth::user()->checkRole(4);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->edit == 1) {
            $book = $this->books->find($id);
            $book->title = $request->title;
            $book->author = $request->author;
            $book->genre = $request->genre;
            $book->publisher = $request->publisher;
            $book->publish_date = $request->publish_date;
            $book->publish_date = $request->publish_date;
            if ($book->quantity > $request->quantity && $book->quantity <= $book->quantity_lent) {
                $book->quantity_lent = $request->quantity;
            }
            $book->quantity = $request->quantity;
            $book->available = isset($request->available) ? 1 : 0;

            $book->save();

            return redirect()->route('book.index');
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
        $checkRole = Auth::user()->checkRole(4);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->delete == 1) {
            $this->books->where('id', $id)->delete();

            return response()->json([
                'result' => true,
                'message' => 'Xóa thành công'
            ]);
        }

        return response()->json([
            'result' => false,
            'message' => 'Bạn không có quyền xóa!'
        ]);
    }

    public function active(Request $request, $id)
    {
        $checkRole = Auth::user()->checkRole(4);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->edit == 1) {
            $book = $this->books->find($id);
            $book->available = $request->check;

            $book->save();
            return response()->json([
                'result' => true,
                'message' => 'Cập nhật thành công!',
            ]);
        }

        return response()->json([
            'result' => false,
            'message' => 'Bạn không có quyền cập nhật!',
        ]);
    }
}
