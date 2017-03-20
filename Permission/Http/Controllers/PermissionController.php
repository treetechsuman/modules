<?php

namespace Modules\Permission\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Permission\Repositories\PermissionRepository;
use Session;

class PermissionController extends Controller
{
    private $permissionRepo;
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function __construct(PermissionRepository $permissionRepo)
    {
        $this->permissionRepo = $permissionRepo;
    }

    public function index()
    {
         $permissions = $this->permissionRepo->getAll();
        return view('permission::permission_view',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('permission::permission_add');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->permissionRepo->create($request->all());
        Session::flash('success','permission is added');
        return redirect('permission');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('permission::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $permission = $this->permissionRepo->getById($id);
        return view('permission::permission_edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request,$id)
    {

        if($this->permissionRepo->update($id,$request->all())){
            Session::flash('success','permission is updated');
            return redirect('permission');
        }
        Session::flash('error','permission is not updated');
        return redirect('permission');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        if($this->permissionRepo->delete($id)){
            Session::flash('success','permission is Deleted');
            return redirect('permission');
        }
        Session::flash('error','permission is not Deleted');
        return redirect('permission');
    }
}
