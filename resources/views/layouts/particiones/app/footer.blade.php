@foreach ($configuracions as $configuracion)
    @foreach ($configuracion->colors as $color)
        <footer class="bg-{{ $color->color }} ">
            <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
                <div class="md:flex md:justify-between">
                    <div class="mb-6 md:mb-0">
                        <h1 class="text-white">
                            <a href="/" class="flex flex-col text-custom-blue-gray-300">
                                <span class="text-xl md:text-3xl leading-3 md:leading-6 font-semibold">
                                    Ecommerce
                                </span>
                                <span class="text-xs">
                                    Tienda online
                                </span>
                            </a>
                        </h1>
                    </div>
                    <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-custom-blue-gray-300 uppercase ">Resources</h2>
                            <ul class="text-gray-500  font-medium">
                                <li class="mb-4">
                                    <a href="https://flowbite.com/" class="hover:underline">Ecomerce</a>
                                </li>
                                <li>
                                    <a href="https://tailwindcss.com/" class="hover:underline">Tailwind CSS</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-custom-blue-gray-300 uppercase ">Follow us</h2>
                            <ul class="text-gray-500 dark:text-gray-400 font-medium">
                                <li class="mb-4">
                                    <a href="https://github.com/themesberg/flowbite" class="hover:underline ">Github</a>
                                </li>
                                <li>
                                    <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">Discord</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-custom-blue-gray-300 uppercase ">Legal</h2>
                            <ul class="text-gray-500 dark:text-gray-400 font-medium">
                                <li class="mb-4">
                                    <a href="#" class="hover:underline">Privacy Policy</a>
                                </li>
                                <li>
                                    <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
                <div class="sm:flex sm:items-center sm:justify-between">
                    <span class="text-sm text-gray-500 sm:text-center ">© 2023 <a href="https://flowbite.com/"
                            class="hover:underline">Flowbite™</a>. All Rights Reserved.
                    </span>
                    <div class="flex mt-4 sm:justify-center sm:mt-0">
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 8 19">
                                <path fill-rule="evenodd"
                                    d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Facebook page</span>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 21 16">
                                <path
                                    d="M16.942 1.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.585 11.585 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3A17.392 17.392 0 0 0 .182 13.218a15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.63 10.63 0 0 1-1.706-.83c.143-.106.283-.217.418-.33a11.664 11.664 0 0 0 10.118 0c.137.113.277.224.418.33-.544.328-1.116.606-1.71.832a12.52 12.52 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM6.678 10.813a1.941 1.941 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z" />
                            </svg>
                            <span class="sr-only">Discord community</span>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 17">
                                <path fill-rule="evenodd"
                                    d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .104.922A11.65 11.65 0 0 1 1.38.748a3.936 3.936 0 0 0-.555 2.031 4.046 4.046 0 0 0 1.825 3.354A4.106 4.106 0 0 1 .8 5.74v.051A4.077 4.077 0 0 0 4.06 9.805a4.093 4.093 0 0 1-1.084.143 3.72 3.72 0 0 1-.779-.076 4.12 4.12 0 0 0 3.837 2.833A8.278 8.278 0 0 1 0 14.162a11.654 11.654 0 0 0 6.29 1.843A11.597 11.597 0 0 0 17.91 4.28c0-.18-.005-.354-.014-.528A8.24 8.24 0 0 0 20 1.892Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Twitter page</span>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 .2a10 10 0 0 0-3.162 19.484c.5.09.682-.217.682-.482 0-.237-.009-.865-.013-1.697-2.781.603-3.369-1.34-3.369-1.34-.454-1.153-1.11-1.46-1.11-1.46-.908-.62.068-.608.068-.608 1.004.07 1.532 1.037 1.532 1.037.892 1.528 2.341 1.087 2.91.832.09-.647.35-1.087.636-1.338-2.22-.252-4.555-1.112-4.555-4.944 0-1.091.39-1.983 1.031-2.681-.103-.253-.447-1.272.098-2.65 0 0 .84-.27 2.75 1.024A9.563 9.563 0 0 1 10 4.792a9.56 9.56 0 0 1 2.506.336c1.91-1.294 2.748-1.024 2.748-1.024.547 1.378.202 2.397.1 2.65.642.698 1.03 1.59 1.03 2.681 0 3.842-2.339 4.688-4.566 4.934.36.31.68.92.68 1.854 0 1.337-.012 2.418-.012 2.747 0 .268.18.576.688.48A10.003 10.003 0 0 0 10 .2Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">GitHub account</span>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    @endforeach
@endforeach
