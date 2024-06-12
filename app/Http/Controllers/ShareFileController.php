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

    
}

?>
