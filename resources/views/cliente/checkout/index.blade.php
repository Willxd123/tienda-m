<x-app-layout>
    <div class="-mb-16" x-data="{
        pago: 1
    }">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="col-span-1 py-5 px-4">
                <div class="card lg:max-w-rem[40rem] py-12 px-4 lg:pr-8 sm:pr-6 lg:pl-8 ml-auto">
                    <h1 class="text-2x1 font-semibold mb-2">
                        Pago
                    </h1>
                    <div class="shadow rounded-lg overflow-hidden border border-gray-400">
                        <ul class="divide-y divide-gray-400">
                            <li>
                                <label class="p-4 flex items-center">
                                    <input type="radio" x-model="pago" value="1">
                                    <span class="ml-2">
                                        Tarjeta de debito / credito
                                    </span>
                                    <img class="h-6 ml-auto" src="https://codersfree.com/img/payments/credit-cards.png"
                                        alt="">
                                </label>
                                <div class="p-4 bg-gray-100 text-center border-t border-gray-400" x-show="pago == 1">
                                    <i class="fa-regular fa-credit-card text-9xl "></i>
                                    <p class="mt-2">
                                        Luego de darle click se procedera al pago
                                    </p>
                                </div>
                            </li>
                            <li>
                                <label class="p-4 flex items-center">
                                    <input type="radio" x-model="pago" value="2">
                                    <span class="ml-2">
                                        Deposito bancario o Yape
                                    </span>
                                </label>
                                <div class="p-4 bg-gray-100 flex justify-center border-t border-gray-400" x-cloak
                                    x-show="pago == 2">
                                    <div>
                                        <p>1. Pago por deposito o transferencia bancaria:</p>
                                        <p>- BCP bolivianos: 198-98765432254</p>
                                        <p>- CCI:-153-351-351513231</p>
                                        <p>- Ci: 9049172</p>
                                        <p>2. Pago por Yape</p>
                                        <p>- Yape al numero 73601268 (Ecommerce izi)</p>
                                        <p> Enviar comprobate al 73601268</p>
                                        <p></p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-span-1 py-5 px-4">
                <div class="lg:max-w-rem[40rem] py-12 px-4 lg:pl-8 sm:pr-6 lg:pr-8 ml-auto">
                    <ul class="space-y-4 mb-4">
                        @foreach (Cart::instance('shopping')->content() as $item)
                            <li class="flex items-center space-x-4">
                                <div class="flex-shrink-0 relative">
                                    <img class="h-16 aspect-square" src="{{$item->options->imagen}}" alt="">
                                    <div class="flex justify-center items-center h-6 w-6 bg-blue-500 rounded-full absolute -right-2 -top-2">
                                        <span class="text-white font-semibold">
                                            {{$item->qty}}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="flex-1">
                                    <p>{{$item->name}}</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <p> Bs/. {{$item->price}} </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="flex justify-between">
                        <p>
                            Subtotal
                        </p>
                        <p>
                            Bs/. {{Cart::instance('shopping')->subtotal()}}
                        </p>
                    </div>
                    <hr class="my-3">
                    <div class="flex justify-between mb-4">
                        <p class="text-lg font-semibold">
                            Total
                        </p>
                        <p>
                            Bs/. {{Cart::instance('shopping')->total()}}
                        </p>
                    </div>
                    <div>
                        <button class="btn btn-blue w-full">
                            Finalizar pedido
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
