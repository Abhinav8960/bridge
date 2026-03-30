<?php

namespace Modules\Backend\Http\Controllers\Configuration;

use App\Helpers\Helper;
use App\Helpers\SmsHelper;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Backend\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;



class UserRegistrationController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $users = User::filter($request->all())->whereIn('role_id', array_keys(Helper::InternalRoles()))->latest()->paginate($this->pageSize)->withQueryString();
        return view('backend::configuration.user.index', compact(['users', 'request']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $model = new User();
        return view('backend::configuration.user.create', compact(['model']));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $random = rand(100000, 999999);

        $model =  new User();
        $model->name = $request->name;
        $model->password = Hash::make($random);
        $model->actual_password = $random;
        $model->role_id = $request->role_id;
        $model->phone = $request->phone;
        $model->email = $request->email;
        // $model->status = $request->status;
        if ($model->save()) {

            SmsHelper::UserAssignInternalRole($model->name, Helper::InternalRoles()[$request->role_id], "Skoodos Bridge", $model->phone, $random);
            return redirect()->route('userregistration.index')->with('success', $model->name . ' created successfully.');
        } else {

            return back()->with('error', 'Something is Missing;');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $model = User::where('id', $id)->whereIn('role_id', array_keys(Helper::InternalRoles()))->FirstOrFail();
        return view('backend::configuration.user.edit', compact(['model']));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $model =  User::where('id', $id)->FirstOrFail();
        $model->name = $request->name;
        $model->role_id = $request->role_id;
        $model->phone = $request->phone;
        $model->email = $request->email;
        $model->status = $request->status;
        if ($model->save()) {

            SmsHelper::UserAssignInternalRole($model->name, Helper::InternalRoles()[$request->role_id], "Skoodos Bridge", $model->phone, $model->actual_password);

            return redirect()->route('userregistration.index')->with('success', $model->name . ' Updated successfully.');
        } else {
            return back()->with('error', 'Something is Missing;');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $users = User::findOrFail($id);
        if (Gate::allows('admin')) {
            $users->delete();
            return redirect()->route('userregistration.index')->with('success', 'Role Deleted successfully.');
        } else {
            return back()->with('error', 'Unauthorized');
        }
    }

    public function publish(User $user)
    {
        // dd($user);
        if ($user->status == true) {
            $user->status = false;
        } else {
            $user->status = true;
        }
        $user->update();
        return redirect()->route('userregistration.index');
    }
}
