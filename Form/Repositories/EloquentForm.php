<?php
namespace Modules\Form\Repositories;

use Illuminate\Support\Facades\Auth;
use Modules\Form\Entities\Form;
use Modules\Form\Entities\Field;
use Modules\Form\Entities\Option;
use Modules\Form\Entities\FormSubmission;
use Modules\Form\Entities\Value;
use Modules\Form\Entities\OptionValue;
use Session;
use DB;

/**
* 
*/
class EloquentForm implements FormRepository
{
	private $form;
	private $field;
	private $option;
	private $formSubmission;
	private $value;
	private $optionValue;

	public function __construct(Form $form,Field $field,Option $option,FormSubmission $formSubmission,Value $value, OptionValue $optionValue)
	{
		$this->form = $form;
		$this->field = $field;
		$this->option = $option;
		$this->formSubmission = $formSubmission;
		$this->value = $value;
		$this->optionValue = $optionValue;
	}

	public function getAll(){
		return $this->form->all();
	}

	public function getById($id){
		return $this->form->where('id',$id)->first();
	}

	public function getFormByIdAndClientId($form_id,$client_id){
		return $this->form->where('id','=',$form_id)->where('client_id','=',$client_id)->first();
	}

	public function create(array $attributes){
		//$attributes['user_id']=Auth::id();
		return $this->form->create($attributes);
	}

	public function update($id,array $attributes){
		return $this->form->findorfail($id)->update($attributes);
	}	

	public function delete($id){
		return $this->form->findorfail($id)->delete();
	}

	public function storeField(array $attributes){
		
		for($i=0;$i<count($attributes['name']);$i++){
			$data =array();
			$data['form_id']=$attributes['form_id'];
			$data['name']=$attributes['name'][$i];
			$data['name_key']=$attributes['name_key'][$i];
			$data['type']=$attributes['type'][$i];
			$data['element_type']=$attributes['element_type'][$i];
			$data['validation']=$attributes['validation'][$i];
			/*foreach($attributes['validation'] as $validation){
				$data['validation']=$data['validation'].','.$validation[$i];
			}*/
			//return $data['validation'];
			$data['regex']=$attributes['regex'][$i];

			$this->field->create($data);
		}

		return 'success';		
	}

	public function fieldsByFormId($form_id){
		return $this->field->where('form_id',$form_id)->select('fields.*')->get();
	}

	public function deleteField($field_id){
		return $this->field->findorfail($field_id)->delete();
	}

	public function updateField(array $attributes){
		for($i=0;$i<count($attributes['name']);$i++){
			$data =array();
			$data['id']=$attributes['field_id'][$i];
			$data['form_id']=$attributes['form_id'];
			$data['name']=$attributes['name'][$i];
			$data['name_key']=$attributes['name_key'][$i];
			//$data['type']=$attributes['type'][$i];
			//$data['element_type']=$attributes['element_type'][$i];
			$data['validation']=$attributes['validation'][$i];
			$data['regex']=$attributes['regex'][$i];

			$this->field->findorfail($data['id'])->update($data);
		}

		return 'success';
	}
	public function getFieldById($field_id){
		return $this->field->where('id',$field_id)->first();
	}

	public function storeOption(array $attributes){
			
			foreach($attributes['name'] as $key=>$name){
				//return $key;
					$i=0;
					foreach($attributes['name'][$key] as $name){
						
							$data = array();
							//return $name;
							//$data['name']=$name;
							//return $attributes['order'][$field_id][$i];
							$data['field_id']=$key;
							//return $data['field_id'];
							$data['name'] = $name;
							$data['value'] = $attributes['value'][$key][$i];
							$data['order'] = $attributes['order'][$key][$i];
							//return $data;
							$this->option->create($data);
							$i++;
				}
				
			}
		
		return 'success';		
	}

	public function getOptionByFieldId($field_id){
		return $this->option->where('field_id',$field_id)->get();
	}

	public function deleteOption($option_id){
		return $this->option->findorfail($option_id)->delete();
	}

	public function getOptionById($option_id){
		return $this->option->where('id',$option_id)->first();
	}

	public function updateOption($id,array $attributes){
		return $this->option->findorfail($id)->update($attributes);
	}

	public function formSubmit(array $attributes){
		//prepare data for form_submission table-----
		$formSubmissionData= array();
		$formSubmissionData['form_id']=$attributes['form_id'];
		$formSubmissionData['version']=$attributes['version'];
		$formSubmissionData['submission_date']=date("Y-m-d");
		$formSubmissionData = $this->formSubmission->create($formSubmissionData);

		//return $formSubmissionData;
		$fields = $this->fieldsByFormId($attributes['form_id']);
		//prepare data for values table------------------
		//$valueData = array()
		//$valueData['field_id'];
		
	    //prepare data for value table ---------------
		foreach($fields as $field){
			
			if($field['type']=='checkbox'){
				//return 'suman checkbox';
				$valueData = array();
				$valueData['form_submission_id'] = $formSubmissionData['id'];
				$valueData['field_id']=$this->getFieldIdByNameKeyAndFormId($field['name_key'],$attributes['form_id']);
				//$valueData['value']=$attributes[$field['name_key']];
				foreach($attributes[$field['name_key']] as $checkOption){
					//return $checkOption;
					$valueData['value']=$checkOption;
					$value = $this->value->create($valueData);
				}
				

			}else{
				$valueData = array();
				$valueData['form_submission_id'] = $formSubmissionData['id'];
				$valueData['field_id']=$this->getFieldIdByNameKeyAndFormId($field['name_key'],$attributes['form_id']);
				$valueData['value']=$attributes[$field['name_key']];
				$value = $this->value->create($valueData);

			}
			//return $valueData;
			/*if($field['element']=='checkbox'){
				foreach($attributes[])

			}*/
			
		}
		return $fields;
	}
	private function getFieldIdByNameKeyAndFormId($name_key, $field_id){
		$field = $this->field->where('name_key',$name_key)->where('form_id',$field_id)->first();
		return $field['id'];
	}

	public function getFormSumissionByFormId($form_id){
		return $this->formSubmission->where('form_id',$form_id)->get();
	}

	public function getValueByFieldIdAndSubmissionId($field_id,$submission_id){
		$values = $this->value->where('field_id',$field_id)->where('form_submission_id',$submission_id)->get();
		
		$myvalue = '';
		/*foreach($values as $value){
			$myvalue .= $value['value'] . ' ';
		}*/
		$i = 0;
		$len = count($values);
		foreach ($values as $value) {
		    if ($i == $len - 1) {
		        // last
		        $myvalue .= $value['value'] . ' ';
		    }else{
		    	$myvalue .= $value['value'] . ', ';
		    }
		    // …
		    $i++;
		}

		//return $value['value'];
		return $myvalue;
	}
	
    public function formsByClientId($client_id){
    	$forms =  $this->form->where('client_id','=',$client_id)->get();
    	if(count($forms)>0){
    		return $forms;
    	}else{
    		return false;
    	}
    }

    public function formsByEventId($event_id){
    	//$forms =  $this->form->where('client_id','=',$client_id)->get();
    	$forms =DB::table('forms')
    				->join('event_forms','event_forms.form_id','=','forms.id')
    				->where('event_forms.event_id','=',$event_id)
    				->select('forms.*')
    				->get();
    	if(count($forms)>0){
    		return $forms;
    	}else{
    		return false;
    	}
    }

    public function getFormByIdAndEventId($form_id,$event_id){
		//return $this->form->where('id','=',$form_id)->where('client_id','=',$client_id)->first();
		$forms =DB::table('forms')
    				->join('event_forms','event_forms.form_id','=','forms.id')
    				->where('event_forms.event_id','=',$event_id)
    				->where('event_forms.form_id','=',$form_id)
    				->select('forms.*')
    				->first();
    	if(count($forms)>0){
    		return $forms;
    	}else{
    		return false;
    	}
	}
	
}
