<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Лог статусов за {{ $item->created_at }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <div class="mb-4">
                            <p class="font-bold mb-2">Дата & Время</p>
                            {{ $item->created_at }}
                        </div>
                        <div class="mb-4">
                            <p class="font-bold mb-2">ID кресла</p>
                            {{ $item->chair->device_id }}
                        </div>
                        <div class="mb-4">
                            <p class="font-bold mb-2">Сообщение</p>
                            @dump($item->message)
                        </div>
                        <div>
                            <p class="font-bold mb-2">IP клиента</p>
                            @dump($item->ip)
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
