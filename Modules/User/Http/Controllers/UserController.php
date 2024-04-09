<?php

namespace Modules\User\Http\Controllers;

use App\Models\Role;
use App\Models\UserRole;
use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\User\Http\Requests\UserRequest;



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
        if (Auth::user()->admin == 1 || Auth::user()->checkRole(1)) {
            $title = 'Danh sách người dùng';
            //Kiem tra quyen edit, delete
            $roles = [
                'edit' => Auth::user()->admin == 1 || Auth::user()->checkRole(1)->pivot->edit == 1 ? 1 : 0,
                'delete' => Auth::user()->admin == 1 || Auth::user()->checkRole(1)->pivot->delete == 1 ? 1 : 0,
            ];

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
            return view('user::index', compact('title', 'users', 'dataRequest', 'roles'));
        }

        return redirect()->route('notify');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $checkRole = Auth::user()->checkRole(1);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->add == 1) {
            $title = 'Danh sách người dùng';

            //Danh sach quyen
            $roles = $this->roles::all();

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
        $checkRole = Auth::user()->checkRole(1);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->add == 1) {
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
                if ($request->roles && $roles = $request->roles) {
                    foreach ($roles as $key => $role) {
                        $this->userRoles->create([
                            'user_id' => $insert->id,
                            'role_id' => $key,
                            'add' => isset($role['add']) ? 1 : 0,
                            'edit' => isset($role['edit']) ? 1 : 0,
                            'delete' => isset($role['delete']) ? 1 : 0,
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
        $checkRole = Auth::user()->checkRole(1);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->edit == 1) {
            $title = 'Chỉnh sửa thông tin người dùng';
            $user = $this->users->find($id);

            $roles = $this->roles::all();
            foreach ($roles as $key => $role) {
                $roles[$key]['add'] = $user->checkRole($role->id) ? $user->checkRole($role->id)->pivot->add : 0;
                $roles[$key]['edit'] = $user->checkRole($role->id) ? $user->checkRole($role->id)->pivot->edit : 0;
                $roles[$key]['delete'] = $user->checkRole($role->id) ? $user->checkRole($role->id)->pivot->delete : 0;
            }

            return view('user::edit', compact('title', 'roles', 'user'));
        }
        return redirect()->route('notify');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UserRequest $request, $id)
    {
        $checkRole = Auth::user()->checkRole(1);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->edit == 1) {
            $user = $this->users->find($id);

            if ($user) {
                if ($request->has('change_pass'))
                    $user->password = Hash::make($request->password);

                if ($request->has('name'))
                    $user->name = $request->name;

                if ($request->has('email'))
                    $user->email = $request->email;

                $user->user_id = Auth::id();

                $user->is_admin = $request->is_admin == 'on' ? 1 : 0;
                if ($request->is_admin) {
                    //Xoa tat ca cac quyen truoc do (Neu co)
                    $this->userRoles->where('user_id', $id)->delete();

                    //Them phan quyen admin
                    if ($request->roles && $roles = $request->roles) {
                        foreach ($roles as $key => $role) {
                            $this->userRoles->create([
                                'user_id' => $id,
                                'role_id' => $key,
                                'add' => isset($role['add']) ? 1 : 0,
                                'edit' => isset($role['edit']) ? 1 : 0,
                                'delete' => isset($role['delete']) ? 1 : 0,
                            ]);
                        }
                    }
                }

                $user->save();

                return redirect()->route('user.index');
            }
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
        $checkRole = Auth::user()->checkRole(1);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->delete == 1) {
            $this->users->where('id', $id)->delete();

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

    public function active($id, Request $request)
    {
        $checkRole = Auth::user()->checkRole(1);
        if (Auth::user()->admin == 1 || $checkRole && $checkRole->pivot->edit == 1) {
            $user = $this->users->find($id);
            $user->is_admin = $request->check;
            $user->save();

            return response()->json([
                'result' => true,
                'message' => 'Cập nhật thành công'
            ]);
        }

        return response()->json([
            'result' => false,
            'message' => 'Không có quyền cập nhập'
        ]);
    }
}
