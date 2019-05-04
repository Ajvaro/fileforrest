<?php

namespace App\Http\Controllers\Account;

use App\Models\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\{
    FileStoreRequest,
    FileUpdateRequest
};
use App\Models\FileApproval;

class FileController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $files = auth()->user()->files()->latest()->paginate(5);

        return view('account.files.index', compact('files'));
    }

    /**
     * @param File $file
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(File $file)
    {
        if(!$file->exists) {
            $file = $this->createSkeletonFile();
            return redirect()->route('account.files.create', $file);
        }

        $this->authorize('touch', $file);

        return view('account.files.create', compact('file'));
    }

    /**
     * @param File $file
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(File $file)
    {
        $this->authorize('touch', $file);

        $approval = $file->approvals->first();

        return view('account.files.edit', compact('file', 'approval'));
    }

    /**
     * @param FileStoreRequest $request
     * @param File $file
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(FileStoreRequest $request, File $file)
    {
        $this->authorize('touch', $file);

        $file->fill($request->only(['title', 'overview', 'overview_short', 'price']));
        $file->finished = true;
        $file->save();

        return redirect()->route('account.files.index')->with('success', 'File has been submitted for review.');
    }

    /**
     * @param FileUpdateRequest $request
     * @param File $file
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(FileUpdateRequest $request, File $file)
    {
        $this->authorize('touch', $file);

        $approvalProps = $request->only(File::APPROVAL_PROPERTIES);

        $file->update($request->only(['live', 'price']));

        if($file->needsApproval($approvalProps)) {
            $file->createApproval($approvalProps);
            return back()->with('success', 'Thanks, we will review your changes soon');
        }

        return back()->with('success', 'File updated');
    }

    /**
     * @return mixed
     */
    private function createSkeletonFile()
    {
        return auth()->user()->files()->create([
            'title' => 'Untitled',
            'overview' => 'None',
            'overview_short' => 'None',
            'price' => 0
        ]);

    }

}
