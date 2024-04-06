class StoryAnimator {
    constructor() {
        this.circles = document.querySelectorAll(".story-circle");
        this.avatars = document.querySelectorAll(".avatar");
        this.likeButtons = document.querySelectorAll(".like-button");
        this.addCommentButtons = document.querySelectorAll(".add-comment");

        this.init();
    }

    init() {
        this.animateCircles();
        this.animateAvatars();
        this.setupLikeButtonListeners();
        this.setupAddCommentListeners();
    }

    animateBorder(target) {
        anime({
            targets: target,
            borderColor: [
                { value: "#f06" },
                { value: "#f90" },
                { value: "#f06" },
            ],
            duration: 1000,
            easing: "linear",
            loop: true,
        });
    }

    animateCircles() {
        this.circles.forEach((circle) => {
            this.animateBorder(circle);
        });
    }

    animateAvatars() {
        this.avatars.forEach((avatar) => {
            this.animateBorder(avatar);
        });
    }

    setupLikeButtonListeners() {
        this.likeButtons.forEach((button) => {
            button.addEventListener("click", () => {
                this.likePost(button);
            });
        });
    }
    setupAddCommentListeners() {
        this.addCommentButtons.forEach((button) => {
            button.style.display = 'none'; // Hide the button initially
        });

        this.commentInputs = document.querySelectorAll(".form-control[name='content']");
        this.commentInputs.forEach((input) => {
            input.addEventListener('input', () => {
                const button = input.parentElement.nextElementSibling.querySelector('.add-comment');
                button.style.display = input.value.trim() !== '' ? 'inline-block' : 'none';
            });
        });

        // Add event listener for "View all comments" link
        document.querySelectorAll('.view-comments-link').forEach((link) => {
            link.addEventListener('click', (event) => {
                event.preventDefault(); // Prevent the default link behavior
                const postId = link.getAttribute('data-post-id'); // Get the post ID from the link's data attribute
                const modal = new bootstrap.Modal(document.getElementById('commentModal')); // Get the modal element
                modal.show(); // Show the modal
            });
        });
    }



}

document.addEventListener("DOMContentLoaded", () => {
    new StoryAnimator();
});
