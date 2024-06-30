<div>
    <div>
        <h2>Editar Usuario</h2>

        <div class="card">
            <form wire:submit.prevent="actualizar" enctype="multipart/form-data">
                @csrf
                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" required
                        autocomplete="name" />
                    <x-input-error for="name" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-label class="mb-3">
                        Correo
                    </x-label>
                    <x-input wire:model.defer="email" class="w-full" placeholder="Ingrese el Correo" />
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <x-label class="mb-3">
                        Contraseña
                    </x-label>
                    <x-input wire:model.defer="password" type="password" class="w-full"
                        placeholder="Ingrese la nueva contraseña" />
                    @error('password')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <!-- FOTO DE PERFIL -->
                    <x-label for="photo" class="block font-medium mb-2">
                        Foto de Perfil
                    </x-label>
                    @if ($photo)
                        <div class="mb-4">
                            <img src="{{ $photo->temporaryUrl() }}" alt="Foto de perfil" class="w-20 h-20 rounded-full">
                        </div>
                    @endif
                    <x-input wire:model="photo" type="file" name="photo" id="photo" class="w-full" />
                    @error('photo')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end mt-4">
                    <x-button class="mr-4">
                        Actualizar
                    </x-button>
                </div>
            </form>
        </div>

    </div>

</div>
