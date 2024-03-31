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


}

document.addEventListener("DOMContentLoaded", () => {
    new StoryAnimator();
});
