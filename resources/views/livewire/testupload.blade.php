<div>
    <form wire:submit.prevent="up">
        <input type="file" wire:model="photo">
        @error('photo') <span class="error">{{ $message }}</span> @enderror
        <button type="submit">Save Photo</button>
    </form>

 
    {{ $this->url }}
    User role is: {{ $user->getRoleNames()[0] }}

    <a wire:click.prevent="get_object_v4_signed_url('hipolito-storage-1', 'images/products/10.jpg')">Get object</a>
</div>


