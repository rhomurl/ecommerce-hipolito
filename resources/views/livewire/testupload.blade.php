<div>
    <form wire:submit.prevent="up">
        <input type="file" wire:model="photo">
        @error('photo') <span class="error">{{ $message }}</span> @enderror
        <button type="submit">Save Photo</button>
    </form>

 
    {{ $this->url }}
    User role is: {{ $user->getRoleNames()[0] }}
</div>


