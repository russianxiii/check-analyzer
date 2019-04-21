@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-wrap justify-center">
            <div class="w-full max-w-sm">

                @if (session('resent'))
                    <div class="text-sm border border-t-8 rounded text-green-darker border-green-dark bg-green-lightest px-3 py-4 mb-4" role="alert">
                        Новая ссылка активации отправлена на Ваш e-mail
                    </div>
                @endif

                <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">
                    <div class="font-semibold bg-grey-lightest text-grey-darkest py-3 px-6 mb-0 shadow-inner">
                        Ваш e-mail:
                    </div>

                    <div class="w-full flex flex-wrap p-6">
                        <p class="leading-normal mb-6">
                            Пожалуйста, проверьте Ваш e-mail. Вам должно придти потверждение.
                        </p>

                        <a class="bg-blue hover:bg-blue-dark text-white font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline no-underline ml-auto" href="{{ route('verification.resend') }}">
                            {{ __('Отправить снова.') }}
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
