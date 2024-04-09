<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\School\Entities\School;
use Modules\Student\Entities\Student;
use Modules\Student\Http\Requests\StudentRequest;

class StudentController extends Controller
{
    protected $schools;
    protected $students;

    public function __construct(School $school, Student $student)
    {
        $this->schools = $school;
        $this->students = $student;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if (Auth::user()->admin == 1 || Auth::user()->checkRole(3)) {

            $roles = [
                'edit' => Auth::user()->admin == 1 || Auth::user()->checkRole(3)->pivot->edit == 1 ? 1 : 0,
                'delete' => Auth::user()->admin == 1 || Auth::user()->checkRole(3)->pivot->delete == 1 ? 1 : 0,
            ];

            $title = 'Danh sách Học sinh';

            $schools = $this->schools->select(['id', 'name'])->get();
            $students = $this->students->orderBy('id', 'DESC');
            $dataRequest = $request->all();
            if ($request->keyword && $keyword = $request->keyword) {
                $students = $students->where('id', '=', $keyword)->orWhere('name', 'LIKE', "%{$keyword}%");
            }

            if ($request->phone && $phone = $request->phone) {
                $students = $students->where('phone', $phone);
            }

            if ($request->email && $email = $request->email) {
                $students = $students->where('email', $email);
            }

            if ($request->gender && $gender = $request->gender) {
                $students = $students->where('gender', $gender);
            }

            if ($request->id_card && $id_card = $request->id_card) {
                $students = $students->where('id_card', $id_card);
            }

            if ($request->grade_level && $grade_level = $request->grade_level) {
                $students = $students->where('grade_level', $grade_level);
            }

            if ($request->id_school && $id_school = $request->id_school) {
                $students = $students->where('id_school', $id_school);
            }

            $students = $students->paginate(10);

            return view('student::index', compact('title', 'schools', 'students', 'dataRequest', 'roles'));
        }

        return redirect()->route('notify');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $checkRole = Auth::user()->checkRole(3);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->add == 1) {
            $title = "Thêm mới học sinh";
            $schools = $this->schools->select(['id', 'name'])->get();

            return view('student::create', compact('title', 'schools'));
        }

        return redirect()->route('notify');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StudentRequest $request)
    {
        $checkRole = Auth::user()->checkRole(3);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->add == 1) {
            $this->students->create([
                'name' => $request->name,
                'birthday' => $request->birthday,
                'gender' => $request->gender,
                'grade_level' => $request->grade_level ? $request->grade_level : '',
                'address' => $request->address,
                'parent_guardian_name' => $request->parent_guardian_name,
                'phone' => $request->phone,
                'email' => $request->email ? $request->email : '',
                'id_card' => $request->id_card ? $request->id_card : '',
                'id_school' => $request->id_school,
            ]);

            return redirect()->route('student.index');
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
        return view('student::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $checkRole = Auth::user()->checkRole(3);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->edit == 1) {
            $student = $this->students->find($id);

            if ($student) {
                $title = 'Chỉnh sửa thông tin học sinh';
                $schools = $this->schools->select(['id', 'name'])->get();

                return view('student::edit', compact('title', 'schools', 'student'));
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
    public function update(StudentRequest $request, $id)
    {
        $checkRole = Auth::user()->checkRole(3);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->edit == 1) {
            $school = $this->students->find($id);

            $school->name = $request->name;
            $school->birthday = $request->birthday;
            $school->gender = $request->gender;
            $school->grade_level = $request->grade_level ? $request->grade_level : '';
            $school->address = $request->address;
            $school->parent_guardian_name = $request->parent_guardian_name;
            $school->phone = $request->phone;
            $school->email = $request->email ? $request->email : '';
            $school->id_card = $request->id_card ? $request->id_card : '';
            $school->id_school = $request->id_school;

            $school->save();

            return redirect()->route('student.index');
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
        $checkRole = Auth::user()->checkRole(3);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->delete == 1) {
            $this->students->where('id', $id)->delete();

            return response()->json([
                'result' => true,
                'message' => 'Xóa thành công'
            ]);
        }

        return response()->json([
            'result' => false,
            'message' => 'Bạn không có quyền xóa'
        ]);
    }
}
