// add Course
const addCourseModal = document.getElementById("addCourseModal");
const addCourseModalBtn = document.getElementById("addCourseModalBtn");
const closeModalBtn = document.getElementById("closeModalBtn");

addCourseModalBtn.onclick = function() {
    addCourseModal.style.display = "block";
}

closeModalBtn.onclick = function() {
    addCourseModal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target === addCourseModal) {
        addCourseModal.style.display = "none";
    }
}

// add Content
const addContentModal = document.getElementById("addContentModal");
const addContentModalBtn = document.getElementById("addContentModalBtn");
const closeContentModalBtn = document.getElementById("closeContentModalBtn");

addContentModalBtn.onclick = function() {
    addContentModal.style.display = "block";
}

closeContentModalBtn.onclick = function() {
    addContentModal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target === addContentModal) {
        addContentModal.style.display = "none";
    }
}

// add Exam
const addExamModal = document.getElementById("addExamModal");
const addExamModalBtn = document.getElementById("addExamModalBtn");
const closeExamModalBtn = document.getElementById("closeExamModalBtn");

addExamModalBtn.onclick = function() {
    addExamModal.style.display = "block";
}

closeExamModalBtn.onclick = function() {
    addExamModal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target === addExamModal) {
        addExamModal.style.display = "none";
    }
}

// addQuestionModal
const addQuestionModal = document.getElementById("addQuestionModal");
const addQuestionModalBtn = document.getElementById("addQuestionModalBtn");
const closeQuestionModalBtn = document.getElementById("closeQuestionModalBtn");

addQuestionModalBtn.onclick = function() {
    addQuestionModal.style.display = "block";
}

closeQuestionModalBtn.onclick = function() {
    addQuestionModal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target === addQuestionModal) {
        addQuestionModal.style.display = "none";
    }
}

// addNotificationModal
const addNotificationModal = document.getElementById("addNotificationModal");
const addNotificationModalBtn = document.getElementById("addNotificationModalBtn");
const closeNotificationModalBtn = document.getElementById("closeNotificationModalBtn");

addNotificationModalBtn.onclick = function() {
    addNotificationModal.style.display = "block";
}

closeNotificationModalBtn.onclick = function() {
    addNotificationModal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target === addNotificationModal) {
        addNotificationModal.style.display = "none";
    }
}
