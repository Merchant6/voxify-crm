<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-full max-w-md">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <form wire:submit.prevent="save">
            <div class="flex flex-col space-y-4">
                <x-input-label for="file" :value="__('Select Excel File:')" />
                <input type="file" id="file" wire:model="file" class="border rounded-md px-3 py-2">
                <x-input-error :messages="$errors->get('file')" class="mt-2" />
                @if (session()->has('message'))
                    <x-input-success :messages="session('message')" class="mt-2" />
                @endif    
            </div>
            <br>
            <x-primary-button>{{ __('Upload') }}</x-primary-button>
        </form>
    </div>
</div>
