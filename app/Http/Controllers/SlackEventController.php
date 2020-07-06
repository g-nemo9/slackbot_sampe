<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SlackEventController extends Controller
{
    public function event(Request $request) {
        // challengeを返す実装
        if ( $request->input('type') == 'url_verification') {
            return $request->input('challenge');
        }

        return '';
    }
}
