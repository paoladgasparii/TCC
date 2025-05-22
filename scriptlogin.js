const container = document.querySelector('.container');
const registerBottom = document.querySelector('.register-bottom');
const loginBottom = document.querySelector('.login-bottom');

registerBottom.addEventListener('click', () => {
    container.classList.add('active');
} );

loginBottom.addEventListener('click', () => {
    container.classList.remove('active');
} );