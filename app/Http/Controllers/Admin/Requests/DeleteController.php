<?php

namespace App\Http\Controllers\Admin\Requests;

use App\Models\Request as ModelsRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModelsRequest $req)
    {
        $req->delete();
        return redirect()->route('admin.requests.index')->with('success','Заявка успешно удалена!');
    }
}
