<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $memos = Memo::select('memos.*')
            ->where('user_id', '=', \Auth::id())
            ->whereNull('deleted_at')
            ->orderBy('updated_at', 'DESC')
            ->get();

        return view('create', compact('memos'));
    }

    public function store(Request $request)
    {
        $posts = $request->all();
        // dump die
        // dd($posts);

        Memo::insert(['content' => $posts['content'], 'user_id' => \Auth::id()]);

        return redirect(route('home'));
    }

    public function edit($id)
    {
        $memos = Memo::select('memos.*')
            ->where('user_id', '=', \Auth::id())
            ->whereNull('deleted_at')
            ->orderBy('updated_at', 'DESC')
            ->get();

        $edit_memo = Memo::find($id);

        return view('edit', compact('memos', 'edit_memo'));
    }

    public function update(Request $request)
    {
        $posts = $request->all();
        // dump die
        // dd($posts);

        Memo::where('id', $posts['memo_id'])->update(['content' => $posts['content']]);

        return redirect(route('home'));
    }

    public function destroy(Request $request)
    {
        $posts = $request->all();
        // dump die
        // dd($posts);

        // Memo::where('id', $posts['memo_id'])->delete(); // 物理削除
        Memo::where('id', $posts['memo_id'])->update(['deleted_at' => date("Y-m-d H:i:s", time())]); // 論理削除

        return redirect(route('home'));
    }
}
