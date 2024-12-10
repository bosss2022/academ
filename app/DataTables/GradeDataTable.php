<?php

namespace App\DataTables;

use App\Models\Grade;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class GradeDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'grades.datatables_actions')
        ->addColumn('unit_name', function ($grade) {
            return $grade->enrolment ? $grade->enrolment->unit->unit_name : 'N/A';
          })
        ->addColumn('student_name', function ($grade) {
            return $grade->enrolment->student->admn_no . ' ' . $grade->enrolment->student->surname .' ' . $grade->enrolment->student->first_name  ?? 'N/A';
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Grade $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Grade $model)
    {
        return $model->newQuery()->with('enrolment.student', 'enrolment.unit');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    // Enable Buttons as per your need
//                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
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
            'unit_name'=> ['title' => 'Enrolled Unit'],
            'student_name' => ['title' => 'Student Name'],
            'score',
            'letter_grade'=> ['title' => 'Grade'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'grades_datatable_' . time();
    }
}
