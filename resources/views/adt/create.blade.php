<div wire:ignore.self class="modal fade" id="staticBackdropAdt" data-backdrop="static" data-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabelAdt" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelAdt">Объявление</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Название</label>
                    <input type="text" class="form-control" wire:model.lazy="title" placeholder="Название">
                </div>
                <div class="form-group">
                    <label for="">Цена</label>
                    <input type="text" class="form-control" wire:model.lazy="price" placeholder="Цена">
                </div>

                <div class="form-group">
                    <label for="">Фотографии</label>
                    <div x-data="{ isUploading: false, progress: 0 }"
                         x-on:livewire-upload-start="isUploading = true"
                         x-on:livewire-upload-finish="isUploading = false"
                         x-on:livewire-upload-error="isUploading = false"
                         x-on:livewire-upload-progress="progress = $event.detail.progress">

                        <input type="file" wire:model="images" multiple class="custom-file"/>


                        <div class="mt-2" x-show="isUploading">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                    <div wire:loading wire:target="carousel">
                        Загружается...
                    </div>
                </div>
                <label class="text-center custom-file-upload">
                    @if($images)
                        @foreach ($images as $item)
                            <img id="{{$item}}"
                                 src="{{$item->temporaryUrl()}}"
                                 class="rounded img-fluid" width="200" height="150">
                        @endforeach

                    @endif
                </label>

                <div class="form-group">
                    <label for="">Описание</label>
                    <textarea class="form-control" wire:model.lazy="description"></textarea>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" wire:click.prevent="store()">Сохранить</button>
            </div>
        </div>
    </div>
</div>
