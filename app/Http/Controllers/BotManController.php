<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use App\Conversations\ExampleConversation;
//use Illuminate\Support\Facades\Http;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    public function handle(Request $request)
    {
        // challengeを返す
        if ( $request->input('type') == 'url_verification') {
            // return $request->input('challenge');
            return response($request->input('challenge'), 200)
                -> header('Content-type', 'x-www-form-urlencoded');
        }

        $botman = app('botman');

        $botman->listen();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tinker()
    {
        return view('tinker');
    }

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    public function startConversation(BotMan $bot)
    {
        $bot->startConversation(new ExampleConversation());
    }

    # use Illuminate\Support\Facades\Http;がなぜか見つからないので動かないっぽい。原因はguzzleというパッケージっぽいんだけど詳細不明
//    public function event(Request $request) {
//        // challengeを返す
//        if ( $request->input('type') == 'url_verification') {
//            // return $request->input('challenge');
//            return response($request->input('challenge'), 200)
//                -> header('Content-type', 'x-www-form-urlencoded');
//        }
//
//        # テストで投稿する
//        $user = $request->input('event.user');
//        $text = $request->input('event.text');
//        $request = Http::asForm()->post('https://slack.com/api/chat.postMessage', [
//            'token' => env('SLACK_TOKEN'),
//            'channel' => '@' . $user,
//            'text' => $text
//        ]);
//        return $request->body();
//    }
}
