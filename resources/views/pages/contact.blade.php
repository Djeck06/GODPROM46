@extends('pages.global')

@section('content')
    <div class="py-12">
        <div class="container">
            <div class="flex">
                <div class="w-full lg:w-2/5 px-3">
                    <h2 class="text-3xl font-bold mb-5">{{ __('Contact Us') }}</h2>
                    <p class="text-gray-500 mb-5">Adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis Etiam porta
                        sem ipsum er malesuada magna mollis Nulla vitae elit libero, a pharetra augue. ibero, a pharetra
                        augue Donec sed odio dui.</p>

                    <ul class="space-y-3">
                        <li class="flex items-center space-x-2">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </span>
                            <span>9, Avenue d'Italie, Bâtiment Ulysse, FRANCE</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </span>
                            <span><a href="#">(+33) 0699928598</a></span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <span><a href="mailto:godprom46@gmail.com">godprom46@gmail.com</a></span>
                        </li>
                    </ul>

                </div>

                <div class="w-full lg:w-3/5 px-3">
                    <form class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <x-inputs.label>{{ __('Name') }}</x-inputs.label>
                                    <x-inputs.text name="name" placeholder="{{ __('Name') }}" required />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <x-inputs.label>{{ __('Email') }}</x-inputs.label>
                                    <x-inputs.text type="email" name="email" placeholder="{{ __('Email') }}" required />
                                </div>

                                <div class="col-span-6">
                                    <x-inputs.label>{{ __('Subject') }}</x-inputs.label>
                                    <x-inputs.text name="subject" placeholder="{{ __('Subject') }}" />
                                </div>

                                <div class="col-span-6">
                                    <x-inputs.label>{{ __('Message') }}</x-inputs.label>
                                    <x-inputs.textarea rows="6" name="message" placeholder="{{ __('Message') }}" />
                                </div>

                            </div>
                        </div>

                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
