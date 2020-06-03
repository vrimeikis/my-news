<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmployeeStoreRequest;
use App\Http\Requests\Admin\EmployeeUpdateRequest;
use App\Repositories\AdminRepository;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    /**
     * @var AdminRepository
     */
    private $adminRepository;

    /**
     * EmployeeController constructor.
     * @param AdminRepository $adminRepository
     */
    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $admins = $this->adminRepository->getPaginatedList(null, ['id', 'first_name', 'last_name', 'email']);

        return view('admin.list', ['items' => $admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EmployeeStoreRequest $request
     * @return RedirectResponse
     */
    public function store(EmployeeStoreRequest $request): RedirectResponse
    {
        try {
            $this->adminRepository->createNew($request->getData());
        } catch (Exception $exception) {
            return back()->with('danger', $exception->getMessage())
                ->withInput();
        }

        return redirect()->route('admin.employee.index')
            ->with('success', __('Created'));
    }

    /**
     * Display the specified resource.
     *
     * @param Admin $employee
     * @return View
     */
    public function show(Admin $employee): View
    {
        return view('admin.show', ['item' => $employee]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Admin $employee
     * @return View
     */
    public function edit(Admin $employee): View
    {
        return view('admin.form', ['item' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EmployeeUpdateRequest $request
     * @param Admin $employee
     * @return RedirectResponse
     */
    public function update(EmployeeUpdateRequest $request, Admin $employee): RedirectResponse
    {
        try {
            $employee->update($request->getData());
        } catch (Exception $exception) {
            return back()->with('danger', $exception->getMessage())
                ->withInput();
        }

        return redirect()->route('admin.employee.index')
            ->with('success', __('Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Admin $employee
     * @return RedirectResponse
     */
    public function destroy(Admin $employee): RedirectResponse
    {
        try {
            $employee->delete();
        } catch (Exception $exception) {
            return back()->with('danger', $exception->getMessage());
        }

        return redirect()->route('admin.employee.index')
            ->with('success', __('Deleted'));
    }
}
