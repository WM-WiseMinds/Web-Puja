<div>
    <form>
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                <div class="mb-4 text-center">
                    @if ($id)
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Update Penukaran</h3>
                    @else
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Create Penukaran</h3>
                    @endif
                </div>
                <div class="mb-4">
                    <label for="exampleFormControlInput4" class="block text-gray-700 text-sm font-bold mb-2">Nama
                        Nasabah</label>
                    <select wire:model="tabungan_id" wire:change="updateSaldo"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="exampleFormControlInput4">
                        <option value="">Pilih Nama Nasabah</option>
                        @foreach ($tabungan as $tab)
                            <option value="{{ $tab->id }}">{{ $tab->nasabah->user->name }}</option>
                        @endforeach
                    </select>
                    @error('tabungan_id')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="saldo" class="block text-gray-700 text-sm font-bold mb-2">Saldo Nasabah</label>
                    <input type="text" id="saldo" wire:model="saldo" readonly
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="exampleFormControlInput4" class="block text-gray-700 text-sm font-bold mb-2">Nama
                        Barang</label>
                    <select wire:model="barang_id" wire:change="updateHarga"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="exampleFormControlInput4">
                        <option value="">Pilih Nama Barang</option>
                        @foreach ($barang as $brg)
                            <option value="{{ $brg->id }}">{{ $brg->nama_barang }}</option>
                        @endforeach
                    </select>
                    @error('barang_id')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="harga" class="block text-gray-700 text-sm font-bold mb-2">Harga Barang</label>
                    <input type="text" id="harga_barang" wire:model="harga_barang" readonly
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
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
