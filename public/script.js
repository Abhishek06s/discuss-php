// SAVE SCROLL POSITION

window.addEventListener("beforeunload", () => {
    localStorage.setItem("scrollPosition", window.scrollY);
});


// RESTORE SCROLL POSITION

window.addEventListener("load", () => {
    const scrollPosition = localStorage.getItem("scrollPosition");
    if(scrollPosition){
        window.scrollTo(0, parseInt(scrollPosition));
    }
});


setTimeout(() => {
    const alerts = document.querySelectorAll('.alert-message');
    alerts.forEach(alert => {
        alert.style.opacity = '0';
        alert.style.transform = 'translateY(-20px)';
        alert.style.height = '0';
        alert.style.padding = '0';
        alert.style.margin = '0 auto';
        alert.style.overflow = 'hidden';

        setTimeout(() => {
            alert.remove();
        }, 600);
    });
}, 7000);


// QUESTION TITLE COUNTER

const questionBox = document.getElementById("title");
const questionCharCount = document.getElementById("question-charCount");

if(questionBox && questionCharCount){
    questionBox.addEventListener("input", () => {
        const length = questionBox.value.length;
        questionCharCount.innerText = length;
        if(length == 100){
            questionCharCount.classList.add("warning-text");
            questionCharCount.classList.remove("normal-text");
        }
        else{
            questionCharCount.classList.remove("warning-text");
            questionCharCount.classList.add("normal-text");
        }
    });
}

// QUESTION DESCRIPTION COUNTER

const descriptionBox = document.getElementById("description");
const descriptionCharCount = document.getElementById("description-charCount");

if(descriptionBox && descriptionCharCount){
    descriptionBox.addEventListener("input", () => {
        const length = descriptionBox.value.length;
        descriptionCharCount.innerText = length;
        if(length == 1000){
            descriptionCharCount.classList.add("warning-text");
            descriptionCharCount.classList.remove("normal-text");
        }
        else{
            descriptionCharCount.classList.remove("warning-text");
            descriptionCharCount.classList.add("normal-text");
        }
    });
}


// ANSWER COUNTER

const answerBox = document.getElementById("answer");
const answerCharCount = document.getElementById("answer-charCount");

if(answerBox && answerCharCount){
    answerBox.addEventListener("input", () => {
        const length = answerBox.value.length;
        answerCharCount.innerText =length;
        if(length == 2000){
            answerCharCount.classList.add("warning-text");
            answerCharCount.classList.remove("normal-text");
        }
        else{
            answerCharCount.classList.remove("warning-text");
            answerCharCount.classList.add("normal-text");
        }
    });
}


const scrollBtn = document.getElementById("scrollTopBtn");

window.addEventListener("scroll", () => {
    if(window.scrollY > 300){
        scrollBtn.style.display = "block";
    }
    else{
        scrollBtn.style.display = "none";
    }
});

scrollBtn.addEventListener("click", () => {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
});


document.querySelectorAll(".like-btn").forEach(button => {
    button.addEventListener("mouseenter", () => {
        button.style.transform = "scale(1.1)";
    });

    button.addEventListener("mouseleave", () => {
        button.style.transform = "scale(1)";
    });
});


const navbar = document.querySelector(".navbar");
window.addEventListener("scroll", () => {
    if(window.scrollY > 0){
        navbar.style.boxShadow = "0 2px 10px rgba(0,0,0,0.1)";
    }
    else{
        navbar.style.boxShadow = "none";
    }
});