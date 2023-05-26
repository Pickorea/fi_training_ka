<?php
namespace App\Repositories\AlertSystem;

use App\Repositories\BaseRepository;
use App\Models\AlertSystem\SalaryScale;
use Auth;
use DB;

class SalaryScaleRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return SalaryScale::class;
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
		$data['minimum_salary']=$input['minimum_salary'];
		$data['maximum_salary']=$input['maximum_salary'];    
		$item=$this->model();
		$item=new $item($data);
		//$item->owner_organisation_id=$user->organisation_id;
        $item->save();
        
	}

	public function update(SalaryScale $model, array $input)
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
		$data=[];
		$data['name']=$input['name'];
		$data['job_title_id']=$input['job_title_id'];
		$data['minimum_salary']=$input['minimum_salary'];
		$data['maximum_salary']=$input['maximum_salary'];    
		return $model->update($data);
	}

	
		public function getForDataTable($search = '', $order_by = 'id', $sort = 'asc')
		{
			$dataTableQuery = $this->model->query()
				->select(['id', 'name', 'minimum_salary', 'maximum_salary', 'job_title_id'])
				->with('jobTitle:id,name');

			if (!empty($search)) {
				$search = '%' . strtolower($search) . '%';
				$dataTableQuery->where(function ($query) use ($search) {
					$query->where('name', 'LIKE', $search)
						->orWhereHas('jobTitle', function ($query) use ($search) {
							$query->where('name', 'LIKE', $search);
						});
				});
			}

			$dataTableQuery->orderBy($order_by, $sort);

			return $dataTableQuery->get();
		}


	   
    public function pluck($column = 'name', $key = 'id')
    {
        return $this->model->query()
            ->orderBy($column)
            ->pluck($column, $key);
    }
}

?>