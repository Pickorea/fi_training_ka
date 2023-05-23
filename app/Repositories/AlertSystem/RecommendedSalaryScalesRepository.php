<?php
namespace App\Repositories\AlertSystem;

use App\Repositories\BaseRepository;
use App\Models\AlertSystem\RecommendedSalaryScale;
use Auth;
use DB;

class RecommendedSalaryScalesRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return RecommendedSalaryScale::class;
    }

    	public function create(array $input)
	{
		//$user = Auth::user();

		//if (! $user->can('recreational.create'))
		//{

		//throw new GeneralException(__('exceptions-app.frontend.not_auth'));

		//}
		
		$data=[];
		$data['name']=$input['name'];
		$data['job_title_id']=$input['job_title_id'];
		$data['recommended_minimum_salary']=$input['recommended_minimum_salary'];
		$data['recommended_maximum_salary']=$input['recommended_maximum_salary'];    
		$item=$this->model();
		$item=new $item($data);
		//$item->owner_organisation_id=$user->organisation_id;
        $item->save();
        
	}

	public function update(RecommendedSalaryScale $model, array $input)
	{

	//$user = Auth::user();
	//if (! $user->can('recreational.edit'))
	//{
	//throw new GeneralException(__('exceptions-app.frontend.not_auth'));
	//}
	//	if ($user->organisation_id !== $model->owner_organisation_id)
	//	{
		//	throw  new GeneralException('No privallaged');


	
		//}
		$data=[];
		$data['name']=$input['name'];
		$data['job_title_id']=$input['job_title_id'];
		$data['recommended_minimum_salary']=$input['recommended_minimum_salary'];
		$data['recommended_maximum_salary']=$input['recommended_maximum_salary'];    
		$item=$this->model();   
		return $model->update($data);
	}


	   
    public function pluck($column = 'name', $key = 'id')
    {
        return $this->model->query()
            ->orderBy($column)
            ->pluck($column, $key);
    }
}

?>