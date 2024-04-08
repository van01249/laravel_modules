<?php

namespace Modules\User\Http\Controllers;

use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Role\Entities\Models\Role;
use Modules\User\Http\Requests\UserRequest;
use Modules\UserRole\Entities\Models\UserRole;

class UserController extends Controller
{
    protected $users;
    protected $roles;
    protected $userRoles;

    public function __construct(User $user, Role $role, UserRole $userRole)
    {
        $this->users = $user;
        $this->roles = $role;
        $this->userRoles = $userRole;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if (Auth::user()->checkRole(2)) {
            $title = 'Danh sách người dùng';

            //Dữ liệu tìm kiếm
            $dataRequest = $request->all();

            //Danh sách người dùng
            $users = $this->users->orderBy('id', 'DESC');
            if ($request->keyword && $keyword = $request->keyword) {
                $users = $users->where('id', $keyword)->orWhere('name', 'LIKE', "%{$keyword}%");
            }

            if ($request->email && $email = $request->email) {
                $users = $users->where('email', $email);
            }

            $users = $users->paginate(10);
            return view('user::index', compact('title', 'users', 'dataRequest'));
        }

        return redirect()->route('notify');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        if (Auth::user()->checkRole(3)) {
            $title = 'Danh sách người dùng';

            //Danh sach quyen
            $roles = $this->roles->where('id_parent', '<>', 0)->orderBy('id', 'ASC')->get();

            return view('user::create', compact('title', 'roles'));
        }

        return redirect()->route('notify');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(UserRequest $request)
    {
        if (Auth::user()->checkRole(3)) {
            $insert = $this->users->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_admin' => $request->is_admin ? 1 : 0,
                'user_id' => Auth::id(),
            ]);

            if ($request->is_admin) {
                //Xoa tat ca cac quyen truoc do (Neu co)
                $this->userRoles->where('user_id', $insert->id)->delete();

                //Them phan quyen admin
                if ($request->actives && $actives = $request->actives) {
                    foreach ($actives as $key => $active) {
                        $role = $this->roles->find($key);
                        //Kiểm tra xem đã thêm id_parent vào bảng user_role chưa
                        $checkRole = $this->userRoles->where(['user_id' => $insert->id, 'role_id' => $role->id_parent])->first();
                        if (!$checkRole) {
                            $this->userRoles->create([
                                'user_id' => $insert->id,
                                'role_id' => $role->id_parent,
                            ]);
                        }

                        $this->userRoles->create([
                            'user_id' => $insert->id,
                            'role_id' => $key,
                        ]);
                    }
                }
            }

            return redirect()->route('user.index');
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
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('user::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function active($id, Request $request)
    {
        // if (Auth::user()->checkRole(4)) {
        $user = $this->users->find($id);
        $user->is_admin = $request->check;
        $user->save();

        return response()->json([
            'result' => true,
            'message' => 'Cập nhật thành công'
        ]);
        // }

        // return response()->json([
        //     'result' => false,
        //     'message' => 'Không có quyền cập nhập'
        // ]);
    }
}
