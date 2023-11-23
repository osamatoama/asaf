@extends('website.layouts.main')

@section('content')
    <div class="user-preferences-form-container" data-quiz-url="{{ route('api.quiz') }}">
        <h1 class="main-heading">اعرف عطرك حسب شخصيتك</h1>
        <div class="gender-selection">
            <h2>حدد النوع</h2>
            <div class="gender-options">
                <div class="gender" data-gender-id="1">
                    <div class="img-wrapper">
                        <img src="{{ asset('quiz/images/gender-1.png') }}" alt="male">
                    </div>
                    <span>ذكر</span>
                </div>
                <div class="gender" data-gender-id="2">
                    <div class="img-wrapper">
                        <img src="{{ asset('quiz/images/gender-2.png') }}" alt="female">
                    </div>
                    <span>أنثى</span>
                </div>
            </div>
            <button class="show-form hidden">ابدأ الأختبار</button>
        </div>
        <div class="multistep-form-wrapper hidden switch-effect">
            <span class="back-to-gender-selection">
                الرجوع لتحديد النوع
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                    <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/>
                </svg>
            </span>
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
                <h2 class="result-title">العطور المناسبة لشخصيتك</h2>
                <div class="products-container"></div>
                <button class="start-over">إعادة الإختبار</button>
            </div>
        </div>
    </div>
@endsection
