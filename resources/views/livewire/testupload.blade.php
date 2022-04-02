<div>
    <form wire:submit.prevent="save">
        @if ($photo)
            Photo Preview:
            <img src="{{ $photo->temporaryUrl() }}">
        @endif
     
        <input type="file" wire:model="photo">
     
        @error('photo') <span class="error">{{ $message }}</span> @enderror
     
        <button type="submit">Save Photo</button>
    </form>

    <a href="#" wire:click.prevent="addQuantity">Add QUantity</a>

    User role is: {{ $user->getRoleNames()[0] }}
</div>


