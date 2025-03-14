<?php

namespace App\Http\Controllers\Uploads;

use App\Http\Controllers\Controller;
use App\Services\UploadService;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    protected $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    public function storeUpload(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'file' => 'required|file|max:10240', // Max 10MB
        ]);

        $upload = $this->uploadService->storeUpload(
            $request->file('file'),
            $request->category_id,
            auth()->id()
        );

        return response()->json($upload);
    }

    public function getUploadsByCategory(Request $request)
    {
        $request->validate(['category_id' => 'required|exists:categories,id']);
        return response()->json($this->uploadService->getUploadsByCategory($request->category_id));
    }

    public function deleteUpload(Request $request)
    {
        $request->validate(['id' => 'required|exists:uploads,id']);
        $this->uploadService->deleteUpload($request->id);
        return response()->json(['message' => 'File deleted successfully']);
    }
}
