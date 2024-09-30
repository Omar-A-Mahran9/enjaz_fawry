<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Setting;

class PermissionController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $roles = Role::latest()->paginate($setting->paginate);
        return view('dashboard.moderators.roles', ['roles' => $roles]);
    }

    public function Create()
    {  
        return view('dashboard.moderators.create_role');
    }

    public function store(Request $r)
    {
        $r->validate([
            'name' => ['required', 'string', 'max:255'],
            'permissions' => ['required'],
        ]);
        $role = Role::create(['name' => $r->name]);
        $role->syncPermissions($r->permissions);
        return redirect()->route('dashboard.permissions.index')->with('success', 'تم الدور بنجاح');

    }

    public function edit($id)
    {
        $role = Role::find($id);
        return view('dashboard.moderators.edit_role', ['role' => $role]);
    }

    public function update(Request $r, $id)
    {
        $r->validate([
            'name' => ['required', 'string', 'max:255'],
            'permissions' => ['required'],
        ]);
        $role = Role::find($id);

        foreach ($r->permissions as $key => $per) {
            $role->revokePermissionTo($per);
        }
        $role->syncPermissions($r->permissions);
        return redirect()->route('dashboard.permissions.index')->with('success', 'تم الدور بنجاح');
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect()->route('dashboard.permissions.index')->with('success', 'تم حذف الدور بنجاح');
    }
    
}
