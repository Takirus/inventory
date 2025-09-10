<?php

namespace App\Http\Controllers;

use App\Models\Software;
use Illuminate\Http\Request;

class SoftwareController extends Controller
{
    public function index()
    {
        $softwares = Software::with('softwareVersion')->paginate(10);
        return view('software.index',
        [
            'softwares' => $softwares,
        ]
    );
    }

}
