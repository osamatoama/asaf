const storedAnswers = {};

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
                    <span class="answer">${answer.answer}</span>
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
            renderStepsHeader(data.questions.length);
            renderFormQuestions(data.questions);
        });
}

function renderProducts(products) {
    let productsMarkup = "";
    products.forEach((product) => {
        productsMarkup += `
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
    });
    return productsMarkup;
}

function getProductsHandler(url) {
    const fetchProductsRes = fetch(url, {
        method: "POST",
        headers: {
            "content-type": "application/json",
            accept: "application/json",
        },
        body: JSON.stringify({ gender_id:1, results: storedAnswers }),
    });
    fetchProductsRes
        .then(function (res) {
            return res.json();
        })
        .then(function (data) {
            document.querySelector(".preferences-test-done .products-container").insertAdjacentHTML("beforeend", renderProducts(data.products));
            document.querySelector(".multistep-form-wrapper").classList.add("hidden");
            document.querySelector(".preferences-test-done").classList.remove("hidden");
            setTimeout(() => {
                document.querySelector(".preferences-test-done").classList.remove("switch-effect");
            }, 600);
        });
}

function submitAndGetResult(e, submitBtn) {
    e.preventDefault();
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
        const nextStep = document.querySelector(
            `.form-step[data-step='${currentStepNum + 1}']`
        );
        if (nextStep) {
            const currentStep = document.querySelector(".form-steps-wrapper .form-step.active");
            const questionId = currentStep.querySelector(".question").dataset.id;
            const answerId = currentStep.querySelector(".answer-wrapper.selected").dataset.id;
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
            window.scroll({
                top: buttonsWrapper.getBoundingClientRect().top + 50,
                behavior: "smooth",
            });
            buttonsWrapper.querySelector(".submit-form-btn").classList.add("animate");
            setTimeout(() => {
                buttonsWrapper.querySelector(".submit-form-btn").classList.remove("animate");
            }, 1200);
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

quizRequestHandler();
