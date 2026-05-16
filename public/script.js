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
