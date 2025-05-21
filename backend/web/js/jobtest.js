let questionIndex = 0;

function addQuestion() {
    const container = document.getElementById('questions-container');
    const template = document.getElementById('question-template').innerHTML;
    const html = template.replace(/__index__/g, questionIndex);
    container.insertAdjacentHTML('beforeend', html);
    questionIndex++;
}

function removeQuestion(button) {
    const questionDiv = button.closest('.question-item');
    questionDiv.remove();
}
