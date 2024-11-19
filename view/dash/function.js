let currentIndex = 0;
const slides = document.querySelectorAll('.background-slide');

function changeSlide() {
    slides[currentIndex].classList.remove('active');
    currentIndex = (currentIndex + 1) % slides.length;
    slides[currentIndex].classList.add('active');
}

setInterval(changeSlide, 5000); // Change every 5 seconds
// FAQ Toggle Script
/*const faqQuestions = document.querySelectorAll('.faq-question');
faqQuestions.forEach(question => {
    question.addEventListener('click', () => {
        const faqItem = question.parentElement;
        faqItem.classList.toggle('active');
    });
});*/


function showSection(sectionId) {
    // Hide all sections
    const sections = document.querySelectorAll('.section-content');
    sections.forEach(section => {
        section.style.display = 'none';
    });
     // Show the selected section
     const selectedSection = document.getElementById(sectionId + '-content');
     if (selectedSection) {
         selectedSection.style.display = 'block';
     }
}
document.addEventListener('DOMContentLoaded', () => {
    showSection('profile');
});
