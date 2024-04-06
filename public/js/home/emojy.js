const picker = new window.EmojiButton();

document.addEventListener('DOMContentLoaded', function() {
    const trigger = document.querySelector('.trigger');

    picker.on('emoji', selection => {
        const input = document.querySelector('#commentInput');
        input.value += selection.emoji;
    });

    trigger.addEventListener('click', () => picker.togglePicker(trigger));
});
