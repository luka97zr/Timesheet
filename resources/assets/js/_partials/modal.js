const modal = {
    modalBtn: document.querySelector('.btn-modal'),
    modalBg: document.querySelector('.modal'),
    close: document.querySelector('.modal__close'),

    init: function() {
        if (modalBg !== null) {
            modalBtn.addEventListener('click', () => {
                modalBg.classList.add('modal--show');
            });
            close.addEventListener('click', () => {
                modalBg.classList.remove('modal--show');
            });
            window.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    modalBg.classList.remove('modal--show');
                }
            });
        }
    }
}

export default modal