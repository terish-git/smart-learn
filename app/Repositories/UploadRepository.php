<?php

namespace App\Repositories;

use App\Models\Upload;

class UploadRepository
{
    public function storeUpload($data)
    {
        return Upload::create($data);
    }

    public function getUploadsByCategory($categoryId)
    {
        return Upload::where('category_id', $categoryId)->get();
    }

    public function deleteUpload($id)
    {
        return Upload::where('id', $id)->delete();
    }
}
