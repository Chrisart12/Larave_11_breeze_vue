<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class PassportController extends Controller
{
    public function index()
    {
        // dd("eeeeeee");
        return Inertia::render('Passport/Index');
    }

    public function create()
    {
        return Inertia::render('Passport/Create');
    }

    public function edit($id)
    {
        $id = $id;
        return Inertia::render('Passport/Edit', compact('id'));
    }
}
