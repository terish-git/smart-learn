<?php

namespace App\Services;

use App\Repositories\UploadRepository;
use Illuminate\Support\Facades\Storage;

class UploadService
{
    protected $uploadRepository;

    public function __construct(UploadRepository $uploadRepository)
    {
        $this->uploadRepository = $uploadRepository;
    }

    public function storeUpload($file, $categoryId, $userId)
    {
        $path = $file->store('uploads');
        $type = $this->getFileType($file->getClientOriginalExtension());

        $upload = $this->uploadRepository->storeUpload([
            'category_id' => $categoryId,
            'uploaded_by' => $userId,
            'file_path' => $path,
            'type' => $type,
            'original_name' => $file->getClientOriginalName(),
        ]);

        return $upload;
    }

    public function getUploadsByCategory($categoryId)
    {
        return $this->uploadRepository->getUploadsByCategory($categoryId);
    }

    public function deleteUpload($id)
    {
        return $this->uploadRepository->deleteUpload($id);
    }

    private function getFileType($extension)
    {
        $videos = ['mp4', 'mkv', 'avi'];
        $images = ['jpg', 'jpeg', 'png', 'gif'];
        $documents = ['pdf', 'doc', 'docx', 'xls', 'xlsx'];

        if (in_array($extension, $videos)) return 'video';
        if (in_array($extension, $images)) return 'image';
        if (in_array($extension, $documents)) return 'document';

        return 'unknown';
    }
}
