@extends('website.layouts.main')

@section('content')
    <div class="intro-loader">
        <div class="spinner">
        </div>
    </div>
    <div class="intro">
        <div class="intro-logo">
            <img src="https://perfumes-quiz-w8ghy.ondigitalocean.app/quiz/images/logo.png" alt="logo">
        </div>
        <div class="intro-text" data-quiz-info-url="{{ route('api.quiz.info') }}">
            <p class="intro-title text-bold-light"></p>
            <p class="intro-description text-white"></p>
            <button class="start-quiz hidden">اكتشف ذوقك</button>
        </div>
    </div>
    <div class="user-preferences-form-container hidden switch-effect" data-quiz-url="{{ route('api.quiz') }}">
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
                        <button type="submit" data-user-id="${userData.userId}" data-customer-id="${userData.customerId}" data-is-guest="${userData.isGuest}" data-email="${userData.email}" data-phone="${userData.phone}" class="submit-form-btn hidden" data-action="submit" data-url="{{ route('api.results') }}">
                            تأكيد
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="preferences-test-done switch-effect hidden">
            <div class="result-wrapper">
                <h2 class="result-title">{!! $resultTitle !!}</h2>
                <div class="products-container"></div>
                <button class="start-over">إعادة الاختبار</button>
            </div>
        </div>
    </div>
@endsection
