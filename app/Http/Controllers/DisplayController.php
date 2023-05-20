<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDisplayRequest;
use App\Models\Display;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DisplayController extends Controller
{
    /**
     * Show all the displays created by the user.
     */
    public function store(StoreDisplayRequest $request): RedirectResponse
    {
        $display = new Display($request->input());
        $display->user()->associate($request->user());
        $display->save();

        return Redirect::route('display.list');
    }

    /**
     * Show details on a chosen display.
     */
    public function delete(Display $display): RedirectResponse
    {
        $display->delete();

        return Redirect::route('display.list');
    }
}
