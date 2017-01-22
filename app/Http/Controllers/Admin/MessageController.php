<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the messages.
     *
     * @return Response
     */
    public function index()
    {
        $User = new User();
        $users = User::all();
        return view('admin.message.index')->with('users', $users);
    }

    /**
     * 分页
     * @param Request $request
     */
    public function paginate(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        $User = new User();
        $uid = $User->getUidByName($search);

        if (empty($uid)) {
            $datas = Message::where([]);
        } else {
            $datas = Message::where('from_uid', $uid)->orWhere('to_uid', $uid);
        }

        $messages = $datas->skip($start)->take($length)->get()->toArray();
        foreach ($messages as &$message) {
            $message['from_username'] = $User->getNameByUid($message['from_uid']);
            $message['to_username'] = $User->getNameByUid($message['to_uid']);
        }
        $paginate = [
            'draw' => (int) $request->draw,
            'recordsTotal' => Message::count(),
            'recordsFiltered' => $datas->count(),
            'data' => $messages
        ];
        echo json_encode($paginate);die;
    }
}
