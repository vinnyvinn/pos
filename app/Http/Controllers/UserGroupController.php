<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use SmoDav\Models\UserGroup;

class UserGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.user-groups.index')->with('userGroups', UserGroup::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.user-groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permissions = $this->getPermissions($request);
//        $userGroup = UserGroup::create($request->all());

        UserGroup::create([
            'name' => $request->get('name'),
            'permissions' => $permissions
        ]);

        flash('Successfully created a new user group');

        return redirect()->route('user-group.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userGroup = UserGroup::findOrFail($id);
        $userperm = json_decode($userGroup->permissions);
//        dd($userperm);

        return view('users.user-groups.edit')->with('userGroup', $userGroup)
            ->with('userperm', $userperm);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $permissions = $this->getPermissions($request);

        UserGroup::findOrFail($id)->update(['permissions' => $permissions, 'name' => $request->name]);

        flash('Successfully edited the user group');
        return redirect()->route('user-group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserGroup::findOrFail($id)->delete();
        flash('Successfully deleted the user group');

        return redirect()->route('user-group.index');
    }

    public function getPermissions(Request $request)
    {
        return json_encode(array_values($request->get('permissions')));
    }
}
