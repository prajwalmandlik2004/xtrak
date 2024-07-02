<div>
    <div class="chatlist_header">
        <div class="title">{{ $auth_first_name }} {{ $auth_last_name }} -- {{ $auth_trigram }}</div>
        <div class="img_container">
            <img src="https://picsum.photos/id/237/200/300" alt="">
        </div>
    </div>

    <div class="chatlist_body">
        <div class="add_chat_container">
            <button class="add_chat_button" wire:click="openModal">+</button>
        </div>
        @if(count($conversations) > 0)
            @foreach ($conversations as $conversation)
                <div class="chatlist_item {{ $this->hasUnreadMessages($conversation) ? 'unread-message' : '' }}" wire:key="{{$conversation->id}}" wire:click="chatUserSelected({{ $conversation->id }}, {{ $this->getChatUserInstance($conversation, 'id') }})">
                    <div class="chatlist_img_container">
                        <img src="https://picsum.photos/id/{{ $this->getChatUserInstance($conversation, 'id') }}/200/300" alt="">
                    </div>
                    <div class="chatlist_info">
                        <div class="top_row">
                            <div class="list_username">{{ $this->getChatUserInstance($conversation, 'first_name') }}</div>
                            <span class="date">{{ $conversation->messages->last()?->created_at->shortAbsoluteDiffForHumans() }}</span>
                        </div>
                        <div class="bottom_row">
                            <div class="message_body text-truncate">{{ $conversation->messages->last()->body }}</div>
                            <!-- <div class="unread_count">56</div> -->
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            Vous n'avez pas de conversation
        @endif
    </div>
    <!-- Modal -->
    <div x-data="{ open: @entangle('isModalOpen') }">
        <div x-show="open" class="modale">
            <div class="modale-content">
                <span class="close" wire:click="closeModal">&times;</span>
                <h2>Créer un nouveau message</h2>
                @if ($users)
                    <ul>
                        @foreach ($users as $user)
                            <li wire:click="startConversation({{ $user->id }})">{{ $user->trigramme }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>Pas d'utilisateurs disponibles</p>
                @endif
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const closeModalButtons = document.querySelectorAll('.modal-content .close');
            closeModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const modal = button.closest('.modale');
                    if (modal) {
                        modal.style.display = 'none';
                    }
                });
            });

            window.onclick = function(event) {
                const modal = document.querySelector('.modale');
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            }
        });
    </script>
</div>