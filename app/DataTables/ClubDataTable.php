<?php

namespace App\DataTables;

use App\Models\Club;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ClubDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()->eloquent($query)
			   ->addColumn('active', function($club) {
			       return ($club->active)? "true":"false";
			   })
			   ->addColumn('contact', function($club) {

			       $first = $last = "";

			       $clubAdmin = $club->admin();

			       $first = $clubAdmin->firstName;
			       $last  = $clubAdmin->lastName;
			       
			       return $first . " " . $last;
			   })
			   ->addColumn('email', function($club) {

			       $email = "";
			       if (($club->people() != null) &&
				   ($club->people()->first() != null) &&
			           ($club->people()->first()->user != null) &&
			           ($club->people()->first()->user->email != null))
			       {
				   $email = $club->people()->first()->user->email;
			       }
			       
			       return $email;
			   })
			   ->addColumn('action', function($club) {
			       $btn =       '<div class="container">';
			       $btn =         '<div class="row">';
			       $btn = $btn.     '<div class="btn-group">';
			       $btn = $btn.        '<a href=clubs/view/'    . $club->id . ' class="btn btn-primary btn-sm m-1">View</a>';
			       $btn = $btn.        '<a href=clubs/edit/'    . $club->id . ' class="btn btn-primary btn-sm m-1">Edit</a>';
			       
			       if (!$club->active)
			       	   $btn = $btn.    '<a href=clubs/enable/'  . $club->id . ' class="btn btn-warning btn-sm m-1">Start</a>';
			       else
				   $btn = $btn.    '<a href=clubs/disable/' . $club->id . ' class="btn btn-info    btn-sm m-1">Stop</a>';
			       
			       $btn = $btn.        '<a class="btn btn-danger  btn-sm m-1 delete-button" name="' . $club->name . '" id="' . $club->id . '">Delete</a>';			       
			       $btn = $btn.     '</div>';
			       $btn = $btn.  '</div>';
			       $btn = $btn.'</div>';
			       return $btn;
			   });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Club $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Club $model)
    {
	return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
	return $this->builder()
		    ->setTableId('club-table')
		    ->columns($this->getColumns())
		    ->minifiedAjax()
		    ->dom('lBfrtip')
		    ->orderBy([0, 'asc'])
		    ->buttons(
			Button::make('csv'),
			Button::make('excel'),
			Button::make('print')
		    )
		    ->parameters([
			'processing' => true,
			'serverSide' => true,
			'responsive' => true,
			'autoWidth'  => true,
		    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
	return [
	    'name',
	    'active',
	    'website',
	    'subdomain',
	    'contact',
	    'email',
	    'action' => ['orderable' => false, 'searchable' => false]
	];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
	return 'Club_' . date('YmdHis');
    }
}
