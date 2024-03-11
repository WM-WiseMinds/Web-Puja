<div>
    <form>
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                <div class="mb-4">
                    <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Transaksi
                        ID</label>
                    <input type="text"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        readonly id="exampleFormControlInput1" placeholder="Enter Transaksi ID" wire:model="transaksi_id">
                    @error('transaksi_id')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                @foreach ($sampahItems as $index => $item)
                    <div wire:key='sampah-item-{{ $index }}'></div>
                    <div class="mb-4">
                        <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Jenis
                            Sampah</label>
                        <input type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="exampleFormControlInput1" placeholder="Enter Jenis Sampah"
                            wire:model="sampahItems.{{ $index }}.jenis_sampah">
                        @error('jenis_sampah')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Nama
                            Sampah</label>
                        <input type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="exampleFormControlInput1" placeholder="Enter Nama Sampah"
                            wire:model="sampahItems.{{ $index }}.nama_sampah">
                        @error('nama_sampah')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Harga
                            Sampah</label>
                        <input type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="exampleFormControlInput1" placeholder="Enter Harga Sampah"
                            wire:model="sampahItems.{{ $index }}.harga_sampah">
                        @error('harga_sampah')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Jumlah
                            Sampah</label>
                        <input type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="exampleFormControlInput1" placeholder="Enter Jumlah Sampah"
                            wire:model="sampahItems.{{ $index }}.jumlah_sampah">
                        @error('jumlah_sampah')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <button type="button" wire:click.prevent="removeSampahItem({{ $index }})"
                            class="inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-red-600 text-base font-bold text-white hover:bg-red-700 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150">
                            Remove Sampah
                        </button>
                    </div>
                @endforeach
                <div class="mb-4">
                    <button type="button" wire:click.prevent="addSampahItem"
                        class="inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-blue-600 text-base font-bold text-white hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition ease-in-out duration-150">
                        Add Sampah Item
                    </button>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                    <button wire:click.prevent="store()" type="button"
                        class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-bold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Submit
                    </button>
                </span>
                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                    <button wire:click="closeModal()" type="button"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-bold text-gray-700 shadow-sm hover:text-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Close
                    </button>
                </span>
            </div>
    </form>
</div>
