<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class Chatbox extends Component
{
    public $selectedConversation;
    public $receiver;
    public $messages_count;
    public $messages;
    public $receiverInstance; 
    public $height;
    public $paginateVar = 10;

    protected $listeners = ['loadConversation', 'pushMessage', 'loadMore', 'updateHeight'];

    public function pushMessage($messageId)
    {   
        $newMessage = Message::find($messageId);
        $this->messages->push($newMessage);
        $this->dispatch('rowChatToBottom');
    }

    public function loadMore()
    {
        $this->messages_count = Message::where('conversation_id', $this->selectedConversation->id)->count();

        $this->messages = Message::where('conversation_id', $this->selectedConversation->id)
            ->skip(max(0, $this->messages_count - $this->paginateVar))
            ->take($this->paginateVar)
            ->get();

        $this->paginateVar += 10;

        $height = $this->height;
        $this->dispatch('updatedHeight', $height);
    }

    public function updateHeight($height)
    {
        $this->height = $height;
    }

    public function loadConversation(Conversation $conversation, $receiverId)
    {
        $this->selectedConversation = $conversation;
        $this->receiverInstance = User::find($receiverId);

        $this->messages_count = Message::where('conversation_id', $this->selectedConversation->id)->count();

        $this->messages = Message::where('conversation_id', $this->selectedConversation->id)
            ->skip($this->messages_count - $this->paginateVar)
            ->take($this->paginateVar)
            ->get();

        $this->dispatch('chatSelected');
    }

    public function render()
    {
        return view('livewire.chat.chatbox', [
            'messages' => $this->messages,
            'receiverInstance' => $this->receiverInstance
        ]);
    }
}
