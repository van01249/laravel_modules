<?php

namespace Modules\School\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\School\Entities\School;
use Modules\School\Http\Requests\SchoolRequest;

class SchoolController extends Controller
{
    protected $schools;

    public function __construct(School $school)
    {
        $this->schools = $school;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $checkRole = Auth::user()->checkRole(2);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole) {
            $title = 'Danh sách trương học';

            //Quyen sua xoa
            $roles = [
                'edit' => Auth::user()->admin == 1 || Auth::user()->checkRole(2)->pivot->edit == 1 ? 1 : 0,
                'delete' => Auth::user()->admin == 1 || Auth::user()->checkRole(2)->pivot->delete == 1 ? 1 : 0,
            ];

            //Danh sách bien trên url
            $dataRequest = $request->all();
            $schools = $this->schools->orderBy('id', 'DESC');
            if ($request->keyword && $keyword = $request->keyword) {
                $schools = $schools->where('id', '=', $keyword)->orWhere('name', 'LIKE', "%{$keyword}%");
            }

            if ($request->phone && $phone = $request->phone) {
                $schools = $schools->where('phone', '=', $phone);
            }

            if ($request->email && $email = $request->email) {
                $schools = $schools->where('email', '=', $email);
            }
            $schools = $schools->paginate(10);

            return view('school::index', compact('title', 'schools', 'dataRequest', 'roles'));
        }

        return redirect()->route('notify');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $checkRole = Auth::user()->checkRole(2);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->add == 1) {
            $title = 'Thêm trường học';

            return view('school::create', compact('title'));
        }

        return redirect()->route('notify');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(SchoolRequest $request)
    {
        $checkRole = Auth::user()->checkRole(2);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->add == 1) {
            $this->schools->create([
                'name' => $request->name,
                'address' => $request->address,
                'descriptions' => $request->descriptions,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);

            return redirect()->route('school.index');
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
        return view('school::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $checkRole = Auth::user()->checkRole(2);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->edit == 1) {
            $title = 'Chỉnh sửa thông tin trường học';

            $school = $this->schools->find($id);

            return view('school::edit', compact('title', 'school'));
        }

        return redirect()->route('notify');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(SchoolRequest $request, $id)
    {
        $checkRole = Auth::user()->checkRole(2);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->edit == 1) {
            $school = $this->schools->find($id);

            $school->name = $request->name;
            $school->address = $request->address;
            $school->descriptions = $request->descriptions;
            $school->phone = $request->phone;
            $school->email = $request->email;

            $school->save();

            return redirect()->route('school.index');
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
        $checkRole = Auth::user()->checkRole(2);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->delete == 1) {
            $this->schools->where('id', $id)->delete();

            return response()->json([
                'result' => true,
                'message' => 'Xóa thành công'
            ]);
        }
        ;

        return response()->json([
            'result' => false,
            'message' => 'Bạn không có quyền xóa'
        ]);
    }
}
