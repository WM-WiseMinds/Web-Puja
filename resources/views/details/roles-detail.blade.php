<div class="p-2 bg-white border border-slate-200">
    <table class="table-auto w-full">
        <tbody>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Permissions</td>
                <td class="border px-4 py-2">
                    <ul class="list-disc pl-8">
                        @foreach ($row->permissions as $permission)
                            <li>{{ $permission->name }}</li>
                            <!-- Ganti 'name' dengan field yang mengandung nama permission -->
                        @endforeach
                    </ul>
                </td>
            </tr>
        </tbody>
    </table>
</div>
