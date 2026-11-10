document.addEventListener('DOMContentLoaded', () => {
    const alerts = document.querySelectorAll('.auto-dismiss');

    alerts.forEach((alert) => {
        setTimeout(() => {
            alert.classList.add('alert-hiding');

            setTimeout(() => {
                alert.remove();
            }, 400);
        }, 4000);
    });
});