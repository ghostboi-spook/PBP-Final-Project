// Full storyline content
const fullStorylineContent = `
<p class="mb-3">Officers Judy Hopps and Nick Wilde are still fighting to be taken seriously as detectives - a struggle that gets worse when their off-the-books smuggling probe turns into a public disaster. With Chief Bogo threatening to split them up, the pair chase one last lead: a mysterious snake seen near the crime scene. That trail leads them to Gary DeSnake, a pit viper fugitive obsessed with exposing a secret behind the city's climate-controlling weather walls...</p>

<p class="mb-3">As Judy and Nick dive deeper into the mystery, they discover a conspiracy that threatens to unravel the delicate peace between predator and prey in Zootopia. Their investigation takes them through all districts of the vibrant city - from the humid Rainforest District to the frozen Tundratown, and from the opulent Sahara Square to the mysterious Nocturnal District.</p>

<p class="mb-3">Meanwhile, the city prepares for its annual "Harmony Festival," a celebration of the unity between all animal species. But when key evidence disappears from police custody and a prominent city official goes missing, Judy and Nick must race against time to solve the case before the festival begins, all while dealing with their own personal challenges and the skepticism of their colleagues.</p>

<p class="mb-3">New alliances are formed and old friendships are tested as the duo uncovers a plot that goes deeper than they ever imagined. With the help of some unexpected allies, including a tech-savvy shrew and a street-smart otter, Judy and Nick must use all their skills to prevent a catastrophe that could destroy Zootopia's fragile ecosystem and social harmony.</p>
`;

// DOM elements
const playBtn = document.getElementById("playBtn");
const modal = document.getElementById("modal");
const closeModal = document.getElementById("closeModal");
const watchlist = document.getElementById("watchlist");
const readMoreBtn = document.getElementById("readMoreBtn");
const storylineContent = document.getElementById("storylineContent");
const addReviewBtn = document.getElementById("addReviewBtn");
const reviewModal = document.getElementById("reviewModal");
const closeReviewModal = document.getElementById("closeReviewModal");
const cancelReview = document.getElementById("cancelReview");
const reviewForm = document.getElementById("reviewForm");
const ratingStars = document.querySelectorAll(".rating-star");
const ratingValue = document.getElementById("ratingValue");
const selectedRating = document.getElementById("selectedRating");

// Modal functionality
if (playBtn) {
    playBtn.addEventListener("click", () => {
        modal.classList.remove("hidden");
        modal.classList.add("flex");
        document.body.style.overflow = "hidden";
    });
}

if (closeModal) {
    closeModal.addEventListener("click", () => {
        modal.classList.add("hidden");
        modal.classList.remove("flex");
        document.body.style.overflow = "";
    });
}

// Close modal on outside click
modal.addEventListener("click", (e) => {
    if (e.target === modal) {
        modal.classList.add("hidden");
        modal.classList.remove("flex");
        document.body.style.overflow = "";
    }
});

// Watchlist toggle functionality
if (watchlist) {
    watchlist.addEventListener("click", () => {
        const added = watchlist.dataset.added === "1";

        if (!added) {
            watchlist.dataset.added = "1";
            watchlist.textContent = "✓ Added to Watchlist";
            watchlist.classList.remove("bg-[var(--imdb-yellow)]");
            watchlist.classList.add("bg-emerald-600");
        } else {
            watchlist.dataset.added = "0";
            watchlist.textContent = "+ Add to Watchlist";
            watchlist.classList.remove("bg-emerald-600");
            watchlist.classList.add("bg-[var(--imdb-yellow)]");
        }
    });
}

// Read more functionality for storyline
if (readMoreBtn && storylineContent) {
    let isExpanded = false;

    readMoreBtn.addEventListener("click", () => {
        isExpanded = !isExpanded;

        if (isExpanded) {
            storylineContent.innerHTML = fullStorylineContent;
            storylineContent.classList.add("full");
            readMoreBtn.textContent = "Show less";
            readMoreBtn.classList.add("bg-neutral-600");
        } else {
            storylineContent.innerHTML = `<p>Officers Judy Hopps and Nick Wilde are still fighting to be taken seriously as detectives - a struggle that gets worse when their off-the-books smuggling probe turns into a public disaster. With Chief Bogo threatening to split them up, the pair chase one last lead: a mysterious snake seen near the crime scene. That trail leads them to Gary DeSnake, a pit viper fugitive obsessed with exposing a secret behind the city's climate-controlling weather walls...</p>`;
            storylineContent.classList.remove("full");
            readMoreBtn.textContent = "Read full storyline";
            readMoreBtn.classList.remove("bg-neutral-600");
        }
    });
}

// Mark as watched button functionality
const markWatchedBtn = document.querySelector(
    "button.bg-neutral-800.text-neutral-300"
);
if (markWatchedBtn) {
    markWatchedBtn.addEventListener("click", () => {
        const isWatched = markWatchedBtn.dataset.watched === "true";

        if (!isWatched) {
            markWatchedBtn.dataset.watched = "true";
            markWatchedBtn.textContent = "✓ Watched";
            markWatchedBtn.classList.remove(
                "bg-neutral-800",
                "text-neutral-300"
            );
            markWatchedBtn.classList.add("bg-blue-600", "text-white");
        } else {
            markWatchedBtn.dataset.watched = "false";
            markWatchedBtn.textContent = "Mark as watched";
            markWatchedBtn.classList.remove("bg-blue-600", "text-white");
            markWatchedBtn.classList.add("bg-neutral-800", "text-neutral-300");
        }
    });
}

// Review Modal Functionality
if (addReviewBtn) {
    addReviewBtn.addEventListener("click", () => {
        reviewModal.classList.remove("hidden");
        reviewModal.classList.add("flex");
        document.body.style.overflow = "hidden";
    });
}

if (closeReviewModal) {
    closeReviewModal.addEventListener("click", () => {
        reviewModal.classList.add("hidden");
        reviewModal.classList.remove("flex");
        document.body.style.overflow = "";
        resetReviewForm();
    });
}

if (cancelReview) {
    cancelReview.addEventListener("click", () => {
        reviewModal.classList.add("hidden");
        reviewModal.classList.remove("flex");
        document.body.style.overflow = "";
        resetReviewForm();
    });
}

// Close review modal on outside click
reviewModal.addEventListener("click", (e) => {
    if (e.target === reviewModal) {
        reviewModal.classList.add("hidden");
        reviewModal.classList.remove("flex");
        document.body.style.overflow = "";
        resetReviewForm();
    }
});

// Rating stars functionality
ratingStars.forEach((star) => {
    star.addEventListener("click", () => {
        const value = parseInt(star.getAttribute("data-value"));
        selectedRating.value = value;
        ratingValue.textContent = `${value}/10`;

        // Update star display
        ratingStars.forEach((s) => {
            if (parseInt(s.getAttribute("data-value")) <= value) {
                s.textContent = "★";
                s.classList.add("active");
            } else {
                s.textContent = "☆";
                s.classList.remove("active");
            }
        });
    });

    // Add hover effect
    star.addEventListener("mouseover", () => {
        const value = parseInt(star.getAttribute("data-value"));
        ratingStars.forEach((s) => {
            if (parseInt(s.getAttribute("data-value")) <= value) {
                s.style.color = "#f5c518";
            }
        });
    });

    star.addEventListener("mouseout", () => {
        const currentValue = parseInt(selectedRating.value);
        ratingStars.forEach((s) => {
            if (parseInt(s.getAttribute("data-value")) > currentValue) {
                s.style.color = "";
            }
        });
    });
});

// Review form submission
if (reviewForm) {
    reviewForm.addEventListener("submit", (e) => {
        e.preventDefault();

        const rating = selectedRating.value;
        const title = document.getElementById("reviewTitle").value;
        const content = document.getElementById("reviewContent").value;

        if (rating === "0") {
            alert("Please select a rating");
            return;
        }

        if (!title.trim()) {
            alert("Please enter a review title");
            return;
        }

        if (!content.trim()) {
            alert("Please enter your review content");
            return;
        }

        // In a real app, you would send this data to a server
        console.log("Review submitted:", { rating, title, content });

        // Show success message
        alert("Thank you for your review! It has been submitted successfully.");

        // Close modal and reset form
        reviewModal.classList.add("hidden");
        reviewModal.classList.remove("flex");
        document.body.style.overflow = "";
        resetReviewForm();

        // Update review count (mock)
        const reviewCountElement = document.querySelector(
            ".text-sm.text-neutral-400"
        );
        if (
            reviewCountElement &&
            reviewCountElement.textContent.includes("User reviews")
        ) {
            const currentText = reviewCountElement.textContent;
            const match = currentText.match(/User reviews · (\d+)/);
            if (match) {
                const currentCount = parseInt(match[1]);
                reviewCountElement.textContent = `User reviews · ${
                    currentCount + 1
                }`;
            }
        }
    });
}

// Function to reset review form
function resetReviewForm() {
    if (reviewForm) reviewForm.reset();
    selectedRating.value = "0";
    ratingValue.textContent = "Select rating";
    ratingStars.forEach((star) => {
        star.textContent = "☆";
        star.classList.remove("active");
        star.style.color = "";
    });
}

// Initialize when DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
    // Smooth scrolling for reviews
    const reviewsContainer = document.querySelector(
        ".reviews-scroll-container"
    );
    if (reviewsContainer) {
        reviewsContainer.style.scrollBehavior = "smooth";
    }

    // Set max height for cast section based on available space
    const castSection = document.querySelector(".cast-scroll");
    if (castSection) {
        // Calculate available height based on viewport
        const viewportHeight = window.innerHeight;
        castSection.style.maxHeight = "12rem"; // Fixed height for single page
    }
});
