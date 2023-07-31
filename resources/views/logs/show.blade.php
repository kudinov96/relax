<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Лог за {{ $item->created_at }}
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
                            <p class="font-bold mb-2">Запрос</p>
                            {{ $item->request }}
                        </div>
                        <div>
                            <p class="font-bold mb-2">Ответ</p>
                            @dump($item->response)
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>