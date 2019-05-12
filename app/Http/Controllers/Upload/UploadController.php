<?php

namespace App\Http\Controllers\Upload;

use App\Models\File;
use App\Models\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Storage;

class UploadController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(File $file, Request $request)
    {
        $this->authorize('touch', $file);

        $uploadedFile = $request->file('file');

        $upload = $this->storeUpload($file, $uploadedFile);

        Storage::disk('local')->putFileAs(
          'files/' . $file->identifier,
          $uploadedFile,
          $upload->filename
        );

        return response()->json([
            'id' => $upload->id
        ]);
    }

    public function storeUpload(File $file, UploadedFile $uploadedFile)
    {
        $upload = new Upload;

        $upload->fill([
            'filename' => $this->generateFilename($uploadedFile),
            'size' => $uploadedFile->getSize()
        ]);

        $upload->file()->associate($file);
        $upload->user()->associate(auth()->user());

        $upload->save();

        return $upload;
    }

    public function destroy(File $file, Upload $upload)
    {
        $this->authorize('touch', $file);
        $this->authorize('touch', $upload);

        if($file->uploads->count() == 1) {
            return response()->json([
               'error' => true,
               'message' => 'You need to leave at least one uploaded file.'
            ], 422);
        }

        $upload->delete($upload);

        return response()->json([], 201);
    }

    protected function generateFilename(UploadedFile $uploadedFile)
    {
        return Str::random() . '_' .  $uploadedFile->getClientOriginalName();
    }
}
