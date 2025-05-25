
let expanded = null;

function createAccordion() {
    const container = document.getElementById('faq-container');
    
    faqs.forEach((faq, index) => {
        const accordion = document.createElement('div');
        accordion.className = 'accordion';
        
        const header = document.createElement('div');
        header.className = 'accordion-header';
        header.innerHTML = `
            <span>${faq.question}</span>
            <span class="icon">+</span>
        `;

        const content = document.createElement('div');
        content.className = 'accordion-content';
        content.innerHTML = faq.answer;

        header.addEventListener('click', () => {
            const isExpanded = content.classList.contains('active');
            
            // Close all accordions
            document.querySelectorAll('.accordion-content').forEach(item => {
                item.classList.remove('active');
            });
            document.querySelectorAll('.accordion-header .icon').forEach(icon => {
                icon.textContent = '+';
            });

            // Toggle current accordion
            if (!isExpanded) {
                content.classList.add('active');
                header.querySelector('.icon').textContent = '−';
                expanded = index;
            } else {
                expanded = null;
            }
        });

        accordion.appendChild(header);
        accordion.appendChild(content);
        container.appendChild(accordion);
    });
}

// Initialize accordion when page loads
window.onload = createAccordion;