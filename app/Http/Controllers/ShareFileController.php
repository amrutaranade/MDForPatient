<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ShareFileService;

class ShareFileController extends Controller
{
    protected $shareFileService;

    public function __construct(ShareFileService $shareFileService)
    {
        $this->shareFileService = $shareFileService;
    }

    public function upload(Request $request)
    {
        $folderName = 'Amruta Phadke Ranade';
        $filePath = $request->file('file')->getPathname();
        $file = $request->file('file');

        try {
            $result = $this->shareFileService->ensureFolderExistsAndUploadFile($request, $folderName, $file);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getShareFilesByFolderId($folderId){
        try {
            $result = $this->shareFileService->getShareFilesByFolderId($folderId);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

?>
