let selectedGenderId;
let storedAnswers = {};
const genderWrapper = document.querySelector('.gender-selection');
const genderOptions = document.querySelectorAll('.gender-selection .gender');
const showFormBtn = document.querySelector('.gender-selection .show-form');

function renderStepsHeader(stepsLength) {
    const stepWrapper = document.querySelector(".steps-header .steps-wrapper");
    for (i = 1; i <= stepsLength; i++) {
        const stepMarkup = `
        <div class="step ${i === 1 ? "active" : ""}" data-step=${i}>
            <span class="step-icon">
                ${i}
            </span>
            <div class="step-desc">
                <span class="step-num">
                    السؤال
                    ${i} / ${stepsLength}
                </span>
            </div>
        </div>
        `;
        stepWrapper.insertAdjacentHTML("beforeend", stepMarkup);
    }
}

function generateAnswerMarkup(answers, questionId, hasImages) {
    let answerMarkup = "";
    answers.forEach((answer, i) => {
        answerMarkup += `
            <div class="answer-wrapper ${i === 0 ? "selected" : ""}" data-id=${answer.id}>
                <label for=q-${questionId}-answer-${i + 1}>
                    ${
                        hasImages
                            ? `<span class="answer-img">
                            <img src="${answer.image.thumbnail}" alt="answer-thumb">
                        </span>`
                            : ""
                    }
                    <span class="answer">${answer.title}</span>
                </label>
                <input type="radio" ${i === 0 ? "checked" : ""} class="answer-inp" id=q-${questionId}-answer-${i + 1}
                    name="q-${questionId}" value="q-${questionId}-answer-${i + 1}">
            </div>
        `;
    });
    return answerMarkup;
}

function renderFormQuestions(questions) {
    const formStepsWrapper = document.querySelector(".multistep-form-wrapper .form-steps-wrapper");
    questions.forEach((question, i) => {
        const stepMarkup = `
            <div class="form-step ${i + 1 === 1 ? "active" : ""}" data-step="${i + 1}">
                <div class="question-wrapper">
                    <p class="question" data-id="${question.id}">${question.question}</p>
                    <div class="answers-wrapper">
                        ${generateAnswerMarkup(question.answers,question.id,question.has_image)}
                    </div>
                </div>
            </div>
        `;
        formStepsWrapper.insertAdjacentHTML("beforeend", stepMarkup);
    });
    initSelectEvent();
    document.querySelector(".multistep-form-wrapper").classList.remove("hidden");
    setTimeout(() => {
        document.querySelector(".multistep-form-wrapper").classList.remove("switch-effect");
    }, 200);
}

function initSelectEvent() {
    document.querySelectorAll(".answer-inp").forEach((inp) => {
        inp.addEventListener("click", function () {
            if (inp.closest(".answer-wrapper").classList.contains("selected")) {
                setTimeout(() => {
                    document.querySelector(".move-to-next-step-btn").click();
                }, 300);
                return;
            }
            Array.from(inp.closest(".answers-wrapper").children).forEach(
                (answer) => {
                    answer.classList.remove("selected");
                }
            );
            inp.closest(".answer-wrapper").classList.add("selected");
            setTimeout(() => {
                document.querySelector(".move-to-next-step-btn").click();
            }, 300);
        });
    });
}

function quizRequestHandler() {
    const QUIZ_URL = document.querySelector(".user-preferences-form-container").dataset.quizUrl;
    const fetchQuizRes = fetch(QUIZ_URL, {
        method: "GET",
        headers: {
            "content-type": "application/json",
            accept: "application/json",
        },
    });
    fetchQuizRes
        .then(function (res) {
            return res.json();
        })
        .then(function (data) {
            renderStepsHeader(data.quiz.questions.length);
            renderFormQuestions(data.quiz.questions);
        });
}

function renderProduct(product) {
    return `
        <div class="product-wrapper">
            <a href="${product.url}" class="product-img">
                <img src="${product.image}" alt="${product.name}">
            </a>
            <div class="links-wrapper">
                <a class="product-title" target="_blank" href="${product.url}">${product.name}</a>
                <a class="see-more"  target="_blank" href="${product.url}">المزيد عن العطر</a>
            </div>
        </div>
        `;
}

function showLoader() {
    const resultsWrapper = document.querySelector('.result-wrapper')
    const resultsLastChild = document.querySelector('.start-over');
    const loader = document.createElement('span');
    loader.classList.add('loader', 'spin');
    loader.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 512 512"><path d="M304 48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zm0 416a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM48 304a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm464-48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM142.9 437A48 48 0 1 0 75 369.1 48 48 0 1 0 142.9 437zm0-294.2A48 48 0 1 0 75 75a48 48 0 1 0 67.9 67.9zM369.1 437A48 48 0 1 0 437 369.1 48 48 0 1 0 369.1 437z"/></svg>
    `;
    resultsWrapper.insertBefore(loader, resultsLastChild);
}

function productsObserverHandler (nextPageUrl) {
    const allProducts = document.querySelectorAll(".products-container .product-wrapper");
    const lastProduct = allProducts[allProducts.length - 1]
    const productsObserver = new IntersectionObserver(
        (entries) => {
            if (entries[0].isIntersecting) {
                productsObserver.unobserve(entries[0].target);
                getProductsHandler(nextPageUrl);
            }
        },
        {
            threshold: 1
        }
    );
    productsObserver.observe(lastProduct);
};

function getProductsHandler(url) {
    const fetchProductsRes = fetch(url, {
        method: "POST",
        headers: {
            "content-type": "application/json",
            accept: "application/json",
        },
        body: JSON.stringify({
            user_key: "01234asdf98765",
            results: storedAnswers,
        }),
    });
    fetchProductsRes
        .then(function (res) {
            return res.json();
        })
        .then(function (data) {
            if (data.success) {
                document.querySelector('.result-wrapper .loader')?.remove();
                document.querySelector(".preferences-test-done .products-container").insertAdjacentHTML(
                    "beforeend",
                    renderProduct(data.product)
                );

                document.querySelector(".multistep-form-wrapper").classList.add("hidden");
                document.querySelector(".preferences-test-done").classList.remove("hidden");
                setTimeout(() => {
                    document.querySelector(".preferences-test-done").classList.remove("switch-effect");
                }, 600);
            }
        });
}

function submitAndGetResult(e, submitBtn) {
    e.preventDefault();
    window.scroll({ top: 0, behavior: 'smooth' });
    getProductsHandler(submitBtn.dataset.url);
    document.querySelector(".multistep-form-wrapper").classList.add("switch-effect");
    setTimeout(() => {
        document.querySelector(".multistep-form-wrapper").classList.add("hidden");
    }, 600);
}

function checkSubmitBtn(currentStep) {
    const nextStepNum = currentStep + 1;
    const nextStep = document.querySelector(`.form-step[data-step='${nextStepNum}']`);
    if (nextStep) {
        document.querySelector(".buttons-wrapper .submit-form-btn").classList.add("hidden");
        document.querySelector(".buttons-wrapper .move-to-next-step-btn").classList.remove("hidden");
    } else {
        document.querySelector(".buttons-wrapper .move-to-next-step-btn").classList.add("hidden");
        document.querySelector(".buttons-wrapper .submit-form-btn").classList.remove("hidden");
    }
    document.querySelector(".buttons-wrapper .submit-form-btn").classList.remove("animate");
}

function switchStepsHandler(e, btn) {
    e.preventDefault();
    const formContainer = document.querySelector(".multistep-form-wrapper");
    const buttonsWrapper = document.querySelector(".buttons-wrapper");
    const currentStepNum = +buttonsWrapper.dataset.currentStep;
    const headerCurrentStep = document.querySelector(`.steps-header .step[data-step='${currentStepNum}']`);
    const formCurrentStep = document.querySelector(`.form-step[data-step='${currentStepNum}']`);
    if (btn.dataset.move === "forward") {
        const nextStep = document.querySelector(`.form-step[data-step='${currentStepNum + 1}']`);
        const currentStep = document.querySelector(".form-steps-wrapper .form-step.active");
        const questionId = currentStep.querySelector(".question").dataset.id;
        const answerId = currentStep.querySelector(".answer-wrapper.selected").dataset.id;
        if (nextStep) {
            if (answerId && questionId) {
                storedAnswers[questionId] = answerId;
                formContainer.classList.add("switch-effect");
                setTimeout(() => {
                    window.scroll({
                        top: formContainer.getBoundingClientRect().top,
                        behavior: "smooth",
                    });
                    headerCurrentStep.classList.remove("active");
                    formCurrentStep.classList.remove("active");
                    document.querySelector(`.steps-header .step[data-step='${currentStepNum + 1}']`).classList.add("active");
                    nextStep.classList.add("active");
                    buttonsWrapper.classList.remove("no-prev");
                    buttonsWrapper.dataset.currentStep = currentStepNum + 1;
                    checkSubmitBtn(currentStepNum + 1);
                    formContainer.classList.remove("switch-effect");
                }, 500);
            } else {
                alert("يجب أختيار إجابة");
            }
        } else {
            if (answerId && questionId) {
                storedAnswers[questionId] = answerId;
                window.scroll({
                    top: buttonsWrapper.getBoundingClientRect().top + 50,
                    behavior: "smooth",
                });
                buttonsWrapper.querySelector(".submit-form-btn").classList.add("animate");
                setTimeout(() => {
                    buttonsWrapper.querySelector(".submit-form-btn").classList.remove("animate");
                }, 1200);
            } else {
                alert("يجب أختيار إجابة");
            }
        }
    } else {
        if (currentStepNum > 1) {
            formContainer.classList.add("switch-effect");
            setTimeout(() => {
                window.scroll({
                    top: formContainer.getBoundingClientRect().top,
                    behavior: "smooth",
                });
                headerCurrentStep.classList.remove("active");
                formCurrentStep.classList.remove("active");
                const prevStep = document.querySelector(`.form-step[data-step='${currentStepNum - 1}']`);
                document.querySelector(`.steps-header .step[data-step='${currentStepNum - 1}']`).classList.add("active");
                prevStep.classList.add("active");
                currentStepNum - 1 > 1
                    ? buttonsWrapper.classList.remove("no-prev")
                    : buttonsWrapper.classList.add("no-prev");
                buttonsWrapper.dataset.currentStep = currentStepNum - 1;
                checkSubmitBtn(currentStepNum - 1);
                formContainer.classList.remove("switch-effect");
            }, 600);
        }
    }
}

genderOptions.forEach((gender, i) => {
    gender.addEventListener('click', function () {
        if (!this.classList.contains('selected')) {
            i === 0 ? genderOptions[i + 1].classList.remove('selected') : genderOptions[i - 1].classList.remove('selected');
            this.classList.add('selected');
        }
        selectedGenderId = this.dataset.genderId;
        showFormBtn.classList.remove('hidden');
        window.scroll({ top: showFormBtn.getBoundingClientRect().top + 50, behavior: 'smooth' });
        showFormBtn.classList.add('animate');
        setTimeout(() => {
            showFormBtn.classList.remove('animate');
        }, 1200);
    });
})

quizRequestHandler();

document.querySelector(".move-to-next-step-btn").addEventListener("click", function (e) {
    switchStepsHandler(e, this);
});

document.querySelector(".back-to-prev-step-btn").addEventListener("click", function (e) {
    switchStepsHandler(e, this);
});

document.querySelector(".submit-form-btn").addEventListener("click", function (e) {
    submitAndGetResult(e, this);
});

document.querySelector(".start-over").addEventListener("click", () => location.reload());
