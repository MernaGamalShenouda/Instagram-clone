const circles = document.querySelectorAll('.story-circle');
const avatars = document.querySelectorAll('.avatar');

function animateBorder(circle) {
    anime({
        targets: circle,
        borderColor: [
            { value: '#f06' },
            { value: '#f90' }, 
            { value: '#f06' }, 
        ],
        duration: 1000, 
        easing: 'linear',
        loop: true, 
    });
}

circles.forEach(circle => {
    animateBorder(circle);
});

avatars.forEach(avatar => {
    animateBorder(avatar);
});
