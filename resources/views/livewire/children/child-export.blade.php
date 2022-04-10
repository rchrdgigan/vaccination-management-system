<div>
    <button class="button px-2 mr-1  box" wire:click='export()'>
        <div class="flex">
                Export
            <div wire:loading.delay wire:target="export" class="ml-2" >
                <i data-loading-icon="oval" class="w-4 h-5" ></i>
            </div>
        </div>
    </button>
</div>
