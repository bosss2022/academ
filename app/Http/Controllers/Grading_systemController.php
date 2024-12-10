<?php

namespace App\Http\Controllers;

use App\DataTables\Grading_systemDataTable;
use App\Http\Requests\CreateGrading_systemRequest;
use App\Http\Requests\UpdateGrading_systemRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Grading_systemRepository;
use Illuminate\Http\Request;
use Flash;

class Grading_systemController extends AppBaseController
{
    /** @var Grading_systemRepository $gradingSystemRepository*/
    private $gradingSystemRepository;

    public function __construct(Grading_systemRepository $gradingSystemRepo)
    {
        $this->gradingSystemRepository = $gradingSystemRepo;
    }

    /**
     * Display a listing of the Grading_system.
     */
    public function index(Grading_systemDataTable $gradingSystemDataTable)
    {
    return $gradingSystemDataTable->render('grading_systems.index');
    }


    /**
     * Show the form for creating a new Grading_system.
     */
    public function create()
    {
        return view('grading_systems.create');
    }

    /**
     * Store a newly created Grading_system in storage.
     */
    public function store(CreateGrading_systemRequest $request)
    {
        $input = $request->all();

        $gradingSystem = $this->gradingSystemRepository->create($input);

        Flash::success('Grading System saved successfully.');

        return redirect(route('grading_systems.index'));
    }

    /**
     * Display the specified Grading_system.
     */
    public function show($id)
    {
        $gradingSystem = $this->gradingSystemRepository->find($id);

        if (empty($gradingSystem)) {
            Flash::error('Grading System not found');

            return redirect(route('grading_systems.index'));
        }

        return view('grading_systems.show')->with('gradingSystem', $gradingSystem);
    }

    /**
     * Show the form for editing the specified Grading_system.
     */
    public function edit($id)
    {
        $gradingSystem = $this->gradingSystemRepository->find($id);

        if (empty($gradingSystem)) {
            Flash::error('Grading System not found');

            return redirect(route('grading_systems.index'));
        }

        return view('grading_systems.edit')->with('gradingSystem', $gradingSystem);
    }

    /**
     * Update the specified Grading_system in storage.
     */
    public function update($id, UpdateGrading_systemRequest $request)
    {
        $gradingSystem = $this->gradingSystemRepository->find($id);

        if (empty($gradingSystem)) {
            Flash::error('Grading System not found');

            return redirect(route('grading_systems.index'));
        }

        $gradingSystem = $this->gradingSystemRepository->update($request->all(), $id);

        Flash::success('Grading System updated successfully.');

        return redirect(route('grading_Systems.index'));
    }

    /**
     * Remove the specified Grading_system from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $gradingSystem = $this->gradingSystemRepository->find($id);

        if (empty($gradingSystem)) {
            Flash::error('Grading System not found');

            return redirect(route('grading_systems.index'));
        }

        $this->gradingSystemRepository->delete($id);

        Flash::success('Grading System deleted successfully.');

        return redirect(route('grading_systems.index'));
    }
}
