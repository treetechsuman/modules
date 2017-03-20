<?php

namespace Modules\Event\Http\Controllers;
use Modules\Form\Repositories\FormRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Event\Repositories\EventRepository;
use Modules\Client\Repositories\ClientRepository;
use Session;
use Image;
use Input;
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    private $eventRepo;
    private $formRepo;
    private $clientRepo;

    //protected $redirectTo = 'auth/home';

    public function __construct(EventRepository $eventRepo, FormRepository $formRepo, ClientRepository $clientRepo)
    {
         $this->formRepo = $formRepo;
        $this->eventRepo = $eventRepo;
        $this->clientRepo = $clientRepo;
    }
    public function index()
    {
       $events =  $this->eventRepo->getAll();
        return view('event::index',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $clients=$this->clientRepo->getAll();
        return view('event::create',compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if($this->eventRepo->create($request->all())){
            Session::flash('success','event is created');
            return redirect('event/view');
        }
        Session::flash('error','event is not created');
        return redirect('event/view');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('event::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $event = $this->eventRepo->getById($id);
        return view('event::edit',compact('event'));
    }
    public function single_view($id)
    {
        $event = $this->eventRepo->getById($id);
        return view('event::single-view',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id,Request $request)
    {
        if($this->eventRepo->update($id,$request->all())){
            Session::flash('success','event is Updated');
            return redirect('event/view');
        }
        Session::flash('error','event is not Updated');
        return redirect('event/view');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function delete($id)
    {
        if($this->eventRepo->delete($id)){
            Session::flash('success','event is Deleted');
            return redirect('event/view');
        }
        Session::flash('error','event is not Deleted');
        return redirect('event/view');
    }




    //Add Participent
    public function add_participent($event_id,$client_id){
        $participents =  $this->eventRepo->getAll_participent_byEvent_id($event_id);
        return view('event::participent', compact('event_id','client_id','participents'));
    }

    public function store_participent(Request $request){
        if($this->eventRepo->store_participent($request->all())){
            Session::flash('success','Participent Added Succfully');
            return redirect()->back();
        }
        Session::flash('error','Failed');
        return redirect()->back();
    }

    // public function getAll_participent($event_id,$client_id)
    // {
    //    $participents =  $this->eventRepo->getAll_participent();
    //     return redirect()->route('event/add_participent/'.$event_id.$client_id,['participents' => $participents]);
    // }
    public function delete_participent($id,$event_id,$client_id)
    {
        if($this->eventRepo->delete_participent($id)){
            Session::flash('success','event is Deleted');
            return redirect('event/add_participent/'.$event_id.'/'.$client_id);
        }
        Session::flash('error','event is not Deleted');
        return redirect('event/add_participent/'.$event_id.'/'.$client_id);
    }

    //Add Image
    public function add_image($event_id,$client_id){
        $images =  $this->eventRepo->getAll_image_byEvent_id($event_id);
        return view('event::image', compact('event_id','client_id','images'));
    }

    public function store_image(Request $request){
        $data = $request->all();
        $filename = '';
        if($request->file('image')){
            $extension=$data['image']->getClientOriginalExtension();
            $filename = time() . '.' .$extension;
            $destinationpath='uploads/image/event/';
            $data['image']->move($destinationpath,$filename);
            Image::make($destinationpath.$filename)
                ->resize( 300, 300 )
                ->save($destinationpath.$filename);
        }else{
            echo 'image not found';
        }
        $data = $request->except('image');
        $data['image'] = $filename;
       
        if($this->eventRepo->store_image($data)){
            Session::flash('success','Image Added Succfully');
            return redirect()->back();
        }
        Session::flash('error','Failed');
        return redirect()->back();
    }

    public function delete_image($id,$event_id,$client_id)
    {
        if($this->eventRepo->delete_image($id)){
            Session::flash('success','event is Deleted');
            return redirect('event/add_image/'.$event_id.'/'.$client_id);
        }
        Session::flash('error','event is not Deleted');
        return redirect('event/add_image/'.$event_id.'/'.$client_id);
    }
    public function change_status_of_image($event_id,$client_id){
        $id = $_POST['id'];
        //return $id;
        if($this->eventRepo->change_status_of_image($id,$event_id)){
            Session::flash('success','Status Changed');
            return redirect('event/add_image/'.$event_id.'/'.$client_id);
        }
        Session::flash('error','Status Changed');
        return redirect('event/add_image/'.$event_id.'/'.$client_id);
    }


    //Form Add
    public function add_form($event_id,$client_id){
        $forms = '';
        if($this->formRepo->formsByClientId($client_id)){
            $forms = $this->formRepo->formsByClientId($client_id);
            $myForms = $this->eventRepo->getAssignedForm($event_id);
            // return $forms;
            return view('event::add-form',compact('forms','event_id','client_id','myForms'));
        }
        Session::flash('success','Participent Added Succfully');
        return redirect()->back();

       
    }
    public function assign_form(Request $request){
       
        if($this->eventRepo->assign_form($request->all())){
            Session::flash('success','Form Assigned Succfully');
            return redirect()->back();
        }
        Session::flash('error','Already Assigned');
        return redirect()->back();
    }

    public function change_status_of_assigned_form(){
        $id = $_POST['id'];
        //return $id;
        if($this->eventRepo->change_status_of_assigned_form($id)){
            Session::flash('success','Status Changed');
            return redirect()->back();
        }
        Session::flash('error','Status Changed');
        return redirect()->back();
    }
     public function delete_form($id)
    {
        if($this->eventRepo->delete_form($id)){
            Session::flash('success','event is Deleted');
            return redirect()->back();
        }
        Session::flash('error','event is not Deleted');
        return redirect()->back();
    }
}
