import "./bootstrap";

window.handleStartOfThread = function (id) {
    const target = document.getElementById("comment-" + id);
    if (!target) return;
    target.scrollIntoView({ behavior: "smooth" });
    target.classList.add("bg-sky-200");
    setTimeout(() => target.classList.remove("bg-sky-200"), 1000);
};

document.addEventListener("alpine:init", () => {
    Alpine.store("reply", {
        id: null,
        toggle(id) {
            this.id = this.id === id ? null : id;
        },
    });
});
