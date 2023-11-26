@extends('website.layouts.main')

@section('content')
    <div class="intro">
        <div class="intro-image">
            <img src="{{ asset('quiz/images/intro.jpg') }}" alt="Perfume Quiz">
        </div>
        <div class="intro-text">
            <p class="text-bold-light">محتار بين عطور عسَّاف؟</p>
            <p class="text-bold-dark">لا تشيل هم عسَّاف يفهمك 😉🐎…</p>
            <p class="text-normal-dark">حنّا هنا نساعدك لتصنع العطر المثالي الذي يتناسب مع ذائقتك! </p>
            <p class="text-normal-dark">
                تم إنشاء هذا الاختبار من فريق أبحاث عسَّاف لنكتشف ذوقك الرهيب في العطور
                مدة الاختبار لا تتجاوز الدقيقة…
            </p>
            <button class="start-quiz">ابدأ الأختبار</button>
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
                        <button type="submit" class="submit-form-btn hidden" data-action="submit" data-url="{{ route('api.results') }}">تأكيد</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="preferences-test-done switch-effect hidden">
            <div class="result-wrapper">
                <h2 class="result-title">ذوقك رهيب وعطرك المناسب هو</h2>
                <div class="products-container"></div>
                <button class="start-over">إعادة الإختبار</button>
            </div>
        </div>
    </div>
@endsection
