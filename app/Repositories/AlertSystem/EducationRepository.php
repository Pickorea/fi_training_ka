<?php
namespace App\Repositories\AlertSystem;

use App\Repositories\BaseRepository;
use App\Models\AlertSystem\Education;
use Auth;
use DB;

class EducationRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Education::class;
    }

    	public function create(array $input)
	{
		//$user = Auth::user();

		//if (! $user->can('recreational.create'))
		//{

		//throw new GeneralException(__('exceptions-app.frontend.not_auth'));

		//}
		
		$data=[];
		$data['from_year']=$input['from_year'];
		$data['to_year']=$input['to_year'];
		$data['school_id']=$input['school_id'];
        $data['qualification_id']=$input['qualification_id'];
        $data['employee_id']=$input['employee_id'];
		$item=$this->model();
		$item=new $item($data);
		//$item->owner_organisation_id=$user->organisation_id;
        $item->save();
        
	}

	public function update(Education $model, array $input)
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
		$data['from_year']=$input['from_year'];
		$data['to_year']=$input['to_year'];
		$data['school_id']=$input['school_id'];
        $data['qualification_id']=$input['qualification_id'];
        $data['employee_id']=$input['employee_id'];
		return $model->update($data);
	}

	public function getDataForIndex(){

		$data = DB::table('employees')
		->select('employees.name', 'qualifications.qualification_name', 'schools.school_name', 'educations.from_year', 'educations.to_year','educations.id')
		->leftJoin('educations','employees.id','=','educations.employee_id')
		->leftJoin('schools','educations.school_id','=','schools.id')
		->leftJoin('qualifications','educations.qualification_id','=','qualifications.id')
		->get();

		// if (!empty($search)) {
        //     $search = '%' . strtolower($search) . '%' ;
        //     $data->where(function ($query) use ($search) {
        //         $query->where('id','ILIKE',  $search )
		// 			->orWhere('name','ILIKE',  $search )
		// 			->orWhere('qualification_name','ILIKE',  $search )
		// 			->orWhere('school_name','ILIKE',  $search )
		// 			->orWhere('from_year','ILIKE',  $search )
        //             ->orWhere('to_year','ILIKE',  $search );
        //     });
        // }


        // if ($trashed == "true") {
        //     return $data->onlyTrashed();
        // }
        return $data ;
	}

	public function getForDataTable($search = '', $order_by = '', $sort = 'asc', $trashed = false)
    {

	//   \Barryvdh\Debugbar\Facade::info('Education getForDataTable : "' . $search . '"');
       // $user = Auth::user();
        $dataTableQuery = $this->model->query()
						->leftjoin('work_status','work_status.id', '=', 'Educations.work_status_id')						
                       ->select(['Educations.id', 'Educations.name', 'Educations.age', 'Educations.email', 'work_status.work_status_name']);
         if (!empty($search)) {
            $search = '%' . strtolower($search) . '%' ;
            $dataTableQuery->where(function ($query) use ($search) {
                $query->where('id','ILIKE',  $search )
					->orWhere('name','ILIKE',  $search )
					->orWhere('age','ILIKE',  $search )
					->orWhere('email','ILIKE',  $search )
                    ->orWhere('work_status_name','ILIKE',  $search );
            });
        }


        if ($trashed == "true") {
            return $dataTableQuery->onlyTrashed();
        }
        return $dataTableQuery ;
    }
	   
    public function pluck($column = 'name', $key = 'id')
    {
        return $this->model->query()
            ->orderBy($column)
            ->pluck($column, $key);
    }
}

?>