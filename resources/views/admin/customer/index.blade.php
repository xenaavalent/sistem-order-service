<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-black text-2xl text-slate-800 tracking-tighter italic uppercase text-indigo-600 ml-0">
                Data Pelanggan
            </h2>
        </div>
    </x-slot>

    <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden mt-4">
        <div class="px-8 py-8 border-b border-slate-50 bg-slate-50/30 flex justify-between items-center">
            <h3 class="font-black text-slate-800 uppercase tracking-tight italic">List Member Bengkel</h3>
            <a href="{{ route('customers.create') }}" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white text-[10px] font-black py-3 px-6 rounded-2xl shadow-lg uppercase tracking-widest">
                <i class="fas fa-plus mr-2"></i> Tambah Pelanggan
            </a>
        </div>

        <div class="overflow-x-auto w-full">
            <table class="w-full text-left border-collapse min-w-[700px]">
                <thead class="bg-slate-50/50 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-100">
                    <tr>
                        <th class="px-8 py-5 w-16 text-center">#</th>
                        <th class="px-8 py-5">Nama Pelanggan</th>
                        <th class="px-8 py-5">Email</th>
                        <th class="px-8 py-5">No. Handphone</th>
                        <th class="px-8 py-5 text-center">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($customers as $customer)
                    <tr class="hover:bg-slate-50/50 transition-all">
                        <td class="px-8 py-6 text-sm text-slate-400 text-center">{{ $loop->iteration }}</td>
                        
                        <td class="px-8 py-6">
                            <span class="text-xs font-medium text-slate-600 tracking-tight block uppercase">
                                {{ $customer->name }}
                            </span>
                        </td>

                        <td class="px-8 py-6 text-slate-500 text-xs font-medium">{{ $customer->email }}</td>

                        <td class="px-8 py-6 text-slate-500 text-xs font-medium italic">
                            {{ $customer->phone ?? 'Tidak ada data' }}
                        </td>

                        <td class="px-8 py-6 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('customers.edit', $customer->id) }}" class="px-4 py-2 bg-amber-400 hover:bg-amber-500 text-white text-[10px] font-bold rounded-xl uppercase transition-all shadow-sm">Ubah</a>
                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Hapus pelanggan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-rose-500 hover:bg-rose-600 text-white text-[10px] font-bold rounded-xl uppercase transition-all shadow-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>