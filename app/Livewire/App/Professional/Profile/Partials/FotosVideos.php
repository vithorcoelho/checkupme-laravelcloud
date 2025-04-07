<?php

namespace App\Livewire\App\Professional\Profile\Partials;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FotosVideos extends Component
{
    use WithFileUploads;

    public $photoFiles = [];
    public $photoOrders = [];
    public $photoNames = [];
    public $galleryData = '';
    public $deletedImages = [];
    public $gallery = [];
    public $uploadProgress = 0;

    public function mount()
    {
        $user = Auth::user();

        if ($user && $user->userProfessional) {
            $this->gallery = json_decode($user->userProfessional->gallery, true) ?: [];
        }
    }

    public function saveGallery()
    {
        if (!empty($this->photoFiles)) {
            try {
                $this->validate([
                    'photoFiles.*' => 'image|max:2048',
                ]);
            } catch (\Exception $e) {
                session()->flash('error', 'Erro na validação dos arquivos: ' . $e->getMessage());
                return;
            }
        }

        if (empty($this->galleryData) && empty($this->photoFiles) && empty($this->deletedImages)) {
            session()->flash('message', 'Nenhuma alteração detectada.');
            return;
        }

        $user = Auth::user();
        if (!$user || !$user->userProfessional) {
            session()->flash('error', 'Perfil profissional não encontrado.');
            return;
        }

        try {
            $galleryArray = [];
            if ($this->galleryData) {
                $galleryArray = json_decode($this->galleryData, true) ?: [];
            }

            // Processar exclusões de imagens
            $deletedImagesArray = [];
            if (!empty($this->deletedImages)) {
                $deletedImagesArray = json_decode($this->deletedImages, true) ?: [];

                $currentGallery = [];
                if ($user->userProfessional->gallery) {
                    $currentGallery = json_decode($user->userProfessional->gallery, true) ?: [];
                }

                foreach ($deletedImagesArray as $deletedId) {
                    $imageIndex = array_search($deletedId, array_column($currentGallery, 'id'));
                    if ($imageIndex !== false && isset($currentGallery[$imageIndex]['path'])) {
                        $path = $currentGallery[$imageIndex]['path'];
                        
                        if (Storage::exists($path)) {
                            Storage::delete($path);
                        }
                    }
                }
            }

            // Processar novas imagens
            $newImages = [];
            if (!empty($this->photoFiles)) {
                foreach ($this->photoFiles as $index => $photo) {
                    $order = isset($this->photoOrders[$index]) ? (int)$this->photoOrders[$index] : count($galleryArray) + $index;
                    $originalName = isset($this->photoNames[$index]) ? $this->photoNames[$index] : $photo->getClientOriginalName();
                    
                    $filename = uniqid() . '_' . $originalName;
                    
                    try {
                        $path = $photo->storeAs('gallery', $filename, 'public');
                        $relativePath = 'storage/' . $path;

                        $newImages[] = [
                            'id' => 'img_' . uniqid(),
                            'path' => $path,
                            'url' => $relativePath,
                            'name' => $originalName,
                            'type' => $photo->getMimeType(),
                            'size' => $photo->getSize(),
                            'order' => $order,
                            'created_at' => now()->toDateTimeString(),
                        ];
                    } catch (\Exception $e) {
                        continue;
                    }
                }
            }

            $updatedGallery = array_merge($galleryArray, $newImages);

            $user->updateOrCreateUserProfessional([
                'gallery' => json_encode($updatedGallery)
            ]);

            if ($user && $user->userProfessional) {
                $this->gallery = json_decode($user->userProfessional->gallery, true) ?: [];
            }
            
            $this->reset(['photoFiles', 'photoOrders', 'photoNames', 'galleryData', 'deletedImages']);
            
            $this->dispatch('gallery-updated', ['gallery' => $this->gallery]);
            
            session()->flash('message', 'Galeria salva com sucesso!');
            
            return;

        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao processar as imagens: ' . $e->getMessage());
        }
    }

    public function refreshGallery()
    {
        $user = Auth::user();
        
        if ($user && $user->userProfessional) {
            $this->gallery = json_decode($user->userProfessional->gallery, true) ?: [];
            return $this->gallery;
        }
        
        return [];
    }
}
