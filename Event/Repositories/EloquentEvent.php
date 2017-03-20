<?php
namespace Modules\Event\Repositories;

use Modules\Event\Entities\Event;
use Modules\Event\Entities\Participent;
use Modules\Event\Entities\ImageModel;
use Modules\Event\Entities\AssignForm;

use DB;


/**
* 
*/
class EloquentEvent implements EventRepository
{
	private $event;
	private $participent;
	private $image;
	private $assignForm;
	public function __construct(Event $event,Participent $participent, ImageModel $image, AssignForm $assignForm)
	{
		$this->event = $event;
		$this->participent = $participent;
		$this->image = $image;
		$this->assignForm = $assignForm;
	}

	public function getAll(){
		return $this->event->all();
	}

	public function getById($id){
		return $this->event->where('id',$id)->first();
	}

	public function create(array $attributes){
		//$attributes['client_id'] = 1;
		return $this->event->create($attributes);
	}

	public function update($id,array $attributes){
		return $this->event->findorfail($id)->update($attributes);
	}	

	public function delete($id){
		return $this->event->findorfail($id)->delete();
	}


	public function store_participent(array $attributes){
		return $this->participent->create($attributes);
	}
	public function getAll_participent_byEvent_id($event_id){
		return $this->participent->where('event_id', $event_id)->get();
	}
	public function delete_participent($id){
		return $this->participent->findorfail($id)->delete();
	}
	// public function sortBy_Colume($key){
	// 	return $this
	// }

	public function store_image(array $attributes){
		$attributes['status'] = 'other';
		return $this->image->create($attributes);
	}
	public function getAll_image_byEvent_id($event_id){
		return $this->image->where('event_id', $event_id)->get();
	}
	public function delete_image($id,$event_id,$client_id){
		$oldimage = ImageModel::findOrFail($id);
        $destinationpath='uploads/image/event/';
        if(unlink($destinationpath.$oldimage['image']))
        {
            echo 'old image is deleted';
        }else{
            echo 'unable to delete old image';
        }
		return $this->image->findorfail($id)->delete();
	}
	public function change_status_of_image($id,$event_id){
		$clickedImage = new ImageModel();
		$array = array();
		$clickedImage = $this->image->findorfail($id);
		if($clickedImage['status'] == 'feature'){
			$array['status'] = 'other';
			return $this->image->findorfail($id)->update($array);
		}else{
			 
			$array['status'] = 'feature';
			return $this->image->findorfail($id)->update($array);
		}
	}

	//=========================================================================api===================================================

	public function ApiGetEventByClientId($client_id){
		$mypath='http://localhost:8080/uploads/image/event/';
		$events =  $this->event->where('client_id',$client_id)->get();
		$otherImages = array();
		$result = array();
		foreach ($events as $event) {
			$response = array();
			$response['id'] = $event['id'];
			$response['event_title'] = $event['event_title'];
            $response['start_date'] = $event['start_date'];
            $response['end_date'] = $event['end_date'];
            $response['start_time'] = $event['start_time'];
            $response['end_time'] = $event['end_time'];
            $response['address'] = $event['address'];
            $response['description'] = $event['description'];
            $response['venue'] = $event['venue'];
            $response['event_title'] = $event['event_title'];
            $image = $this->image->where('event_id', $event['id'])->where('status','feature')->first();
			$response['image'] = $mypath.$image['image'];
			
			$images = $this->image->where('event_id', $event['id'])->where('status','other')->get();
			if(count($images)>0){
				foreach ($images as $image) {
					$temp['image'] = $mypath.$image['image'];
					array_push($otherImages,$temp);
				}
				$response['otherImage'] = $otherImages;
			}
			array_push($result,$response);
		}
		
		return $result;
	}
	//Assign form
	public function assign_form($attributes){
		$input = array();
        $input['form_id'] = $attributes['form_id'];
        $input['event_id'] = $attributes['event_id'];
        $input['status'] = 'active';
        if($this->is_assignd($input['event_id'], $input['form_id'])){
        	$this->assignForm->create($input);
        	return true;
        }
        return false;
        

	}

	public function getAssignedForm($event_id){
		return $this->assignForm->where('event_id',$event_id)->get();
	}
	public function is_assignd($event_id,$form_id){
		if(count($this->assignForm->where('event_id',$event_id)->where('form_id', $form_id)->first())>0){
			return false;
		}
		return true;
	}

	public function change_status_of_assigned_form($id){
		$form = new AssignForm();
		$array = array();
		$form = $this->assignForm->findorfail($id);
		if($form['status'] == 'active'){
			$array['status'] = 'inactive';
			return $this->assignForm->findorfail($id)->update($array);
		}else{
			 
			$array['status'] = 'active';
			return $this->assignForm->findorfail($id)->update($array);
		}
	}

	public function delete_form($id){
		return $this->assignForm->findorfail($id)->delete();
	}
}
