<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;

class CreateChat extends Component
{
    public $users;
    public $message="test";

    public function checkconversation($receiverId)
    {
        // dd($receiverId);
        
        $checkedConversation=Conversation::where('receiver_id',auth()->user()->id)->where('sender_id',$receiverId)
        ->orWhere('receiver_id',$receiverId)->where('sender_id',auth()->user()->id)->get();

        if(count($checkedConversation)==0){
            // dd('no conversation');

            $createdConversation=Conversation::create([
                'sender_id'=>auth()->user()->id,
                'receiver_id'=>$receiverId,
            ]);

            $createdMessage= Message::create([
                'conversation_id'=>$createdConversation->id,
                'sender_id'=>auth()->user()->id,
                'receiver_id'=>$receiverId,
                'body'=>$this->message,
            ]);

            $createdConversation->last_time_message = $createdMessage->created_at;
            $createdConversation->save();

            dd('$createdMessage');
            dd('saved');
        }
        else if(count($checkedConversation)>= 1) {
            dd('conversation exists');
            
        }
    }
    public function render()
{
    $this->users = User::where('id', '!=', auth()->user()->id)->get();
    return view('livewire.chat.create-chat')
        ->extends('layouts.app'); 
}

}

