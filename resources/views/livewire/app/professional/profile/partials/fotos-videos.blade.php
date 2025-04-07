<div>
    <x:tailwind.form-box title="Fotos" subtitle="Tenha uma galeria de fotos e vídeos no seu perfil">
        <div x-data="{
            files: [],
            galleryImages: {{ json_encode($gallery) }},
            deletedImages: [],
            uploading: false,

            previewFiles(event) {
                const newFiles = Array.from(event.target.files).map((file, index) => {
                    return {
                        id: 'new_' + Date.now() + index,
                        file: file,
                        url: URL.createObjectURL(file),
                        name: file.name,
                        order: this.files.length + index,
                        isNew: true
                    };
                });
                this.files = [...this.files, ...newFiles];
            },

            removeFile(id) {
                const index = this.files.findIndex(f => f.id === id);
                if (index !== -1) {
                    URL.revokeObjectURL(this.files[index].url);
                    this.files.splice(index, 1);
                    this.files.forEach((file, idx) => file.order = idx);
                }
            },

            removeGalleryImage(id) {
                this.deletedImages.push(id);
                const index = this.galleryImages.findIndex(img => img.id === id);
                if (index !== -1) {
                    this.galleryImages.splice(index, 1);
                }
            },

            updateOrder() {
                const fileElements = document.querySelectorAll('#preview-container .preview-item');
                this.files = Array.from(fileElements).map((el, idx) => {
                    const fileId = el.dataset.id;
                    const file = this.files.find(f => f.id === fileId);
                    if (file) file.order = idx;
                    return file;
                });

                const galleryElements = document.querySelectorAll('#existing-gallery .gallery-item');
                this.galleryImages = Array.from(galleryElements).map((el, idx) => {
                    const imgId = el.dataset.id;
                    const img = this.galleryImages.find(img => img.id === imgId);
                    if (img) img.order = idx;
                    return img;
                });
            },
            
            updateGallery() {
                this.$wire.call('refreshGallery')
                    .then(updatedGallery => {
                        if (updatedGallery) {
                            this.galleryImages = updatedGallery;
                        }
                    });
            },

            saveGallery() {
                this.$wire.set('deletedImages', JSON.stringify(this.deletedImages));
                this.$wire.set('galleryData', JSON.stringify(this.galleryImages));
                
                if (this.files.length > 0) {
                    this.uploading = true;
                    
                    const tempInput = document.createElement('input');
                    tempInput.type = 'file';
                    tempInput.multiple = true;
                    tempInput.style.display = 'none';
                    document.body.appendChild(tempInput);
                    
                    const dataTransfer = new DataTransfer();
                    const ordersArray = [];
                    const namesArray = [];
                    
                    this.files.forEach((fileObj, idx) => {
                        dataTransfer.items.add(fileObj.file);
                        ordersArray.push(fileObj.order);
                        namesArray.push(fileObj.name);
                    });
                    
                    tempInput.files = dataTransfer.files;
                    this.$wire.set('photoOrders', ordersArray);
                    this.$wire.set('photoNames', namesArray);
                    
                    try {
                        this.$wire.uploadMultiple('photoFiles', tempInput.files, 
                            (uploadedFilenames) => {
                                this.$wire.set('photoOrders', ordersArray);
                                this.$wire.set('photoNames', namesArray);
                                this.$wire.call('saveGallery');
                                
                                document.body.removeChild(tempInput);
                                
                                setTimeout(() => {
                                    this.uploading = false;
                                    this.files = [];
                                    
                                    setTimeout(() => {
                                        this.updateGallery();
                                    }, 1000);
                                }, 500);
                            },
                            (error) => {
                                console.error('Erro ao fazer upload das imagens:', error);
                                this.uploading = false;
                                document.body.removeChild(tempInput);
                                alert('Erro no upload das imagens. Tente novamente.');
                            }
                        );
                    } catch (error) {
                        console.error('Erro no processo de upload:', error);
                        document.body.removeChild(tempInput);
                        this.uploading = false;
                        alert('Ocorreu um erro durante o upload. Tente novamente.');
                    }
                } else {
                    this.$wire.call('saveGallery');
                    
                    setTimeout(() => {
                        this.updateGallery();
                    }, 500);
                }
            }
        }" 
        x-init="() => {
            $nextTick(() => {
                if (typeof Sortable !== 'undefined') {
                    new Sortable(document.getElementById('preview-container'), {
                        animation: 150,
                        onEnd: () => updateOrder()
                    });

                    new Sortable(document.getElementById('existing-gallery'), {
                        animation: 150,
                        onEnd: () => updateOrder()
                    });
                }
            });
            
            $wire.on('gallery-updated', (eventData) => {
                if (eventData && eventData.gallery) {
                    galleryImages = eventData.gallery;
                }
            });
        }">

        <!-- Galeria Existente -->
        <div x-show="galleryImages.length > 0">
            <div id="existing-gallery"
                class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                <template x-for="(image, index) in galleryImages" :key="image . id + index">
                    <div class="gallery-item relative border rounded-md overflow-hidden" :data-id="image.id">
                        <img :src="image.url.startsWith('http') ? image.url : '{{ asset('') }}' + image.url" class="w-full h-32 object-cover" />
                        <div class="absolute top-0 right-0 p-1">
                            <flux:icon.x-circle @click="removeGalleryImage(image.id)" class="size-6" variant="solid" class="text-red-500 dark:text-red-500" />
                        </div>
                        <div class="absolute top-0 left-0 p-1 cursor-move">
                           <flux:icon.bars-3 />
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Container para prévia das novas imagens -->
        <div id="preview-container" class="border-top grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mt-4">
            <template x-for="(file, index) in files" :key="file.id+index">
                <div class="preview-item relative border rounded-md overflow-hidden" :data-id="file.id">
                    <img :src="file . url" class="w-full h-32 object-cover" />
                    <div class="absolute top-0 right-0 p-1">
                        <flux:icon.x-circle @click="removeFile(file.id)" class="size-6" variant="solid" class="text-red-500 dark:text-red-500" />
                    </div>
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 p-1 text-white text-xs truncate">
                        <span x-text="file.name"></span>
                    </div>
                </div>
            </template>
        </div>

        <div class="mt-4 flex items-center">
            <flux:input placeholder="Enviar fotos" type="file" size="sm" x-on:change="previewFiles($event)" multiple accept="image/*"/>

            <flux:button size="sm" variant="primary" @click="saveGallery()" wire:loading.attr="disabled">
                <span wire:loading.remove>Salvar</span>
                <span wire:loading>Salvando...</span>
            </flux:button>
        </div>

        @if (session()->has('error'))
            <flux:callout variant="secondary" icon="information-circle" heading="{{ session('error') }}" />
        @endif
        </div>
    </x:tailwind.form-box>
</div>