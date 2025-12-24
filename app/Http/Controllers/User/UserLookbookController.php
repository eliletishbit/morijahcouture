<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Lookbook;


class UserLookbookController extends Controller
{
    public function index()
    {
        $lookbooks = Lookbook::paginate(15);
        return view('pages.frontend.lookbook.index', compact('lookbooks'));
    }

    

    public function show(Lookbook $slug)
    {
        $lookbook = Lookbook::where('slug', $slug->nom)->firstOrFail();
        return view('pages.frontend.lookbook.show', compact('lookbook'));
    }

  

   

}
