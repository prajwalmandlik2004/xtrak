<div>
    @if ($selectedConversation)
        <form wire:submit.prevent='sendMessage' enctype="multipart/form-data">
            <div class="chatbox_footer">
                <div class="custom_form_group">

                    <!-- Display selected attachment -->
                    @if ($attachment)
                        <div class="attachment-preview">
                            @if (in_array($attachment->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif']))
                                <!-- Display image as thumbnail -->
                                <div class="attachment-thumbnail">
                                    <img src="{{ $attachment->temporaryUrl() }}" alt="Image preview">
                                </div>
                            @else
                                <!-- Display file icon and name for other types -->
                                <div class="attachment-icon">
                                    <i class="bi bi-file-earmark"></i>
                                </div>
                                <div class="attachment-filename">
                                    {{ $attachment->getClientOriginalName() }}
                                </div>
                            @endif
                            <button type="button" wire:click="removeAttachment">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                    @endif

                    <input wire:model='body' type="text" class="control" placeholder="Ecrire le message">

                    <input wire:model='attachment' type="file" id="fileInput" style="display: none;">
                    <label for="fileInput" style="font-size: 24px; margin-right: 10px;">
                        <i class="bi bi-paperclip"></i>
                    </label>

                    <button type="submit" class="submit">
                        <i class="bi bi-send-fill"></i>
                    </button>
                </div>
            </div>
        </form>
    @endif
</div>


