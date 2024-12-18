document.querySelectorAll('.tab').forEach(tab => {
    tab.addEventListener('click', () => {
        document.querySelector('.tab.active').classList.remove('active');
        tab.classList.add('active');
        
        document.querySelector('.chat.active').classList.remove('active');
        document.getElementById(tab.getAttribute('data-target')).classList.add('active');
    });
});

document.querySelectorAll('.message-form').forEach(form => {
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const message = form.querySelector('textarea').value;
        const file = form.querySelector('input[type="file"]').files[0];

        console.log('Message:', message);
        if (file) {
            console.log('File:', file.name);
        }
        
        form.reset();
    });
});

document.getElementById('google-signin').addEventListener('click', () => {
    console.log('Google Sign-In clicked');
});