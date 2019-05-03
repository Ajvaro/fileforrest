<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests\FileStoreRequest;
use App\Models\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileController extends Controller
{

    public function index()
    {
        $files = auth()->user()->files()->latest()->paginate(5);

        return view('account.files.index', compact('files'));
    }

    public function create(File $file)
    {
        if(!$file->exists) {
            $file = $this->createSkeletonFile();
            return redirect()->route('account.files.create', $file);
        }

        $this->authorize('touch', $file);

        return view('account.files.create', compact('file'));
    }

    public function store(FileStoreRequest $request, File $file)
    {
        $this->authorize('touch', $file);

        $file->fill($request->only(['title', 'overview', 'overview_short', 'price']));
        $file->finished = true;
        $file->save();

        return redirect()->route('account.files.index')->with('success', 'File has been submitted for review.');
    }

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
