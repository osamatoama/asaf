@extends('website.layouts.main')

@section('content')
    <div class="intro">
        <a href="https://perfume-quiz.valinteca.com/perfume-quiz" class="intro-logo">
            <img src="{{ asset('quiz/images/logo.png') }}" alt="logo">
        </a>
        {{-- <div class="intro-image">
            <img src="{{ asset('quiz/images/intro.jpg') }}" alt="Perfume Quiz">
        </div> --}}
        <div class="intro-text">
            <p class="text-bold-light">{{ $quiz->title }}</p>

            @if(filled($quiz->description))
                <p>
                    {!! $quiz->description !!}
                </p>
            @endif

            <button class="start-quiz">اكتشف ذوقك</button>
        </div>
    </div>
    <div class="user-preferences-form-container" data-quiz-url="{{ route('api.quiz') }}">
        <h1 class="main-heading">اعرف عطرك حسب شخصيتك</h1>
        <div class="multistep-form-wrapper">
            <div class="steps-header">
                <div class="steps-wrapper"></div>
            </div>
            <div class="form-container">
                <form>
                    <div class="form-steps-wrapper"></div>
                    <div class="buttons-wrapper no-prev" data-current-step="1">
                        <button class="back-to-prev-step-btn" data-move="backward">السابق</button>
                        <button class="move-to-next-step-btn" data-move="forward">التالي</button>
                        <button type="submit" class="submit-form-btn hidden" data-action="submit" data-url="{{ route('api.results') }}">تأكيد</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="preferences-test-done switch-effect hidden">
            <div class="result-wrapper">
                <h2 class="result-title">{!! $resultTitle !!}</h2>
                <div class="products-container"></div>
                <button class="start-over">إعادة الإختبار</button>
            </div>
        </div>
    </div>
@endsection
