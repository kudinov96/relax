<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Заказ № {{ $item->id }}
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
                            <p class="font-bold mb-2">ID</p>
                            {{ $item->id }}
                        </div>
                        <div class="mb-4">
                            <p class="font-bold mb-2">Минуты</p>
                            {{ $item->minutes }}
                        </div>
                        <div class="mb-4">
                            <p class="font-bold mb-2">Цена</p>
                            {{ $item->costs }}
                        </div>
                        <div class="mb-4">
                            <p class="font-bold mb-2">Кресло активировалось?</p>
                            @if($item->success_run_chair) Да @else Нет @endif
                        </div>
                        <div class="mb-4">
                            <p class="font-bold mb-2">Платеж прошел?</p>
                            @if($item->success_payment) Да @else Нет @endif
                        </div>
                        <div>
                            <p class="font-bold mb-2">Ошибка</p>
                            {{ $item->response }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>