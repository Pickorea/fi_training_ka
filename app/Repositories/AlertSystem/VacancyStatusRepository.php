<?php
namespace App\Repositories\AlertSystem;

use App\Repositories\BaseRepository;
use App\Models\AlertSystem\VacancyStatus;
use Auth;

class VacancyStatusRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return VacancyStatus::class;
    }

    	public function create(array $input)
	{
		//$user = Auth::user();

		//if (! $user->can('recreational.create'))
		//{

		//throw new GeneralException(__('exceptions-app.frontend.not_auth'));

		//}
		$data=[];
		$data['status']=$input['status'];
		$data['vacancy_id']=$input['vacancy_id'];
		$item=$this->model();
		$item=new $item($data);
		//$item->owner_organisation_id=$user->organisation_id;
        $item->save();
        
	}

	public function update(VacancyStatus $model, array $input)
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
		$data['status']=$input['status'];
		$data['vacancy_id']=$input['vacancy_id'];
		return $model->update($data);
	}
    public function updateStatus(VacancyStatus $model, $status)
    {
        //$user = Auth::user();
        //if (! $user->can('vacancy.edit')) {
        //    throw new GeneralException(__('exceptions-app.frontend.not_auth'));
        //}
        //if ($user->organisation_id !== $model->owner_organisation_id) {
        //    throw  new GeneralException('No privileged');
        //}
        $model->status = $status;
        $model->save();
    }
    public function pluck($column = 'status', $key = 'id')
    {
        return $this->model->query()
            ->orderBy($column)
            ->pluck($column, $key);
    }
}

?>