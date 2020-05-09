<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kemitraan;
use Auth;
use App\User;
use App\Message;
use App\Events\NewMessage;

class ChatController extends Controller
{
    public function get()
    {
        $userId = Auth::user()->id;
        $listMitraSaya = Kemitraan::orWhere(function($query)use($userId){
            $query->orWhere('user2_id',$userId)->orWhere('user1_id',$userId);
        })->where('status',1)->get();
        
        $j=0;
        $listMitraId[] = null;
        foreach($listMitraSaya as $i){
            $user1 = $i->user1_id;
            $user2 = $i->user2_id;
            // dd($user1);
            if($userId == $user1){
                $listMitraId[$j] = $user2;               
            }else if ($userId == $user2){                
                $listMitraId[$j] = $user1;               
            }
            $j++;
        }
        // get all users except the authenticated one
        $contacts = User::whereIn('id',$listMitraId)->get();
        // $contacts = User::where('id', '!=', auth()->id())->get();

        // get a collection of items where sender_id is the user who sent us a message
        // and messages_count is the number of unread messages we have from him
        $unreadIds = Message::select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
            ->where('to', auth()->id())
            ->where('read', false)
            ->groupBy('from')
            ->get();
        
        // add an unread key to each contact with the count of unread messages
        $contacts = $contacts->map(function($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });

        // dd($unreadIds);
        return response()->json([
            'status' => 'success',
            'data' => $contacts,
        ], 200);
    }
    public function getMessagesFor($id)
    {
        // mark all messages with the selected contact as read
        Message::where('from', $id)->where('to', auth()->id())->update(['read' => true]);

        // get all messages between the authenticated user and the selected user
        $messages = Message::where(function($q) use ($id) {
            $q->where('from', auth()->id());
            $q->where('to', $id);
        })->orWhere(function($q) use ($id) {
            $q->where('from', $id);
            $q->where('to', auth()->id());
        })
        ->get();

        return response()->json($messages);
    }
    public function send(Request $request)
    {
        $message = Message::create([
            'from' => auth()->id(),
            'to' => $request->contact_id,
            'text' => $request->text
        ]);

        broadcast(new NewMessage($message));

        return response()->json($message);
    }
}
