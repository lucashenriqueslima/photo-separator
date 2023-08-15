<?php

namespace App\Livewire\Components;

use LivewireUI\Modal\ModalComponent;

class ConfirmUploadImagesModal extends ModalComponent
{
    public function render()
    {
        return view('livewire.components.confirm-upload-images-modal');
    }
}