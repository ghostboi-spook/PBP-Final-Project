// ===== REVIEW MODAL FUNCTIONALITY FOR WATCHLIST =====

document.addEventListener('DOMContentLoaded', function() {
    // Initialize review modal
    initializeReviewModalWatchlist();
    
    // ===== WATCHLIST SPECIFIC FUNCTIONALITY =====
    // Initialize watchlist components
    loadWatchlistItems();
    loadUserLists();
    
    // Initialize watchlist functionality
    initializeEditMode();
    initializeCreateModal();
    initializeInfoModal();
    initializeSorting();
    initializeWatchlistActions();
    
    // Initialize common components
    if (typeof Common !== 'undefined') {
        Common.initializeWatchlistAlert();
    }
});

// ===== WATCHLIST DATA =====

const watchlistData = [
    {
        id: 1,
        position: 1,
        title: "Elio",
        year: 2025,
        duration: "1h 38m",
        rating: 6.7,
        votes: "33K",
        score: "66",
        description: "Elio, a space fanatic with an active imagination, finds himself on a cosmic misadventure where he must form new bonds with alien lifeforms...",
        directors: ["Adrian Molina", "Madeline Sharafian", "Domee Shi"],
        stars: ["Yonas Kibreab", "Zoe Saldaña", "Remy Edgerly"],
        poster: "https://m.media-amazon.com/images/M/MV5BM2Y1Y2I4YzAtZjU2My00ZGI0LThhZmItY2Y3ZTM3NzM1ZTRkXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_.jpg"
    },
    {
        id: 2,
        position: 2,
        title: "Finding Nemo",
        year: 2003,
        duration: "1h 40m",
        rating: 8.2,
        votes: "1.2M",
        score: "90",
        description: "After his son is captured in the Great Barrier Reef and taken to Sydney, a timid clownfish sets out on a journey to bring him home.",
        directors: ["Andrew Stanton", "Lee Unkrich"],
        stars: ["Albert Brooks", "Ellen DeGeneres"],
        poster: "https://m.media-amazon.com/images/M/MV5BNzU0ZDM1M2UtM2I3ZS00ZjAxLWI2ZTUtZWI3ZTMzNjY3ZmM2XkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_.jpg"
    }
];

const userListsData = [
    {
        name: "aktor",
        updated: "updated 1 minute ago",
        icon: "person"
    },
    {
        name: "favorites",
        updated: "updated 5 days ago",
        icon: "heart"
    }
];

// ===== REVIEW MODAL FUNCTIONS =====

function initializeReviewModalWatchlist() {
    const reviewModal = document.getElementById('reviewModal');
    if (!reviewModal) return;

    const closeReviewModal = document.getElementById('closeReviewModal');
    const cancelReview = document.getElementById('cancelReview');
    const reviewForm = document.getElementById('reviewForm');
    const ratingStars = reviewModal.querySelectorAll('.rating-star');
    const ratingValue = document.getElementById('ratingValue');
    const selectedRating = document.getElementById('selectedRating');

    let currentMovieId = null;
    let currentMovieTitle = null;

    // Function to open modal
    window.openReviewModalWatchlist = function(movieId, movieTitle) {
        currentMovieId = movieId;
        currentMovieTitle = movieTitle;
        reviewModal.classList.remove('hidden');
        reviewModal.classList.add('flex');
        document.body.style.overflow = 'hidden';

        // Set movie title in form if available
        const reviewTitleInput = document.getElementById('reviewTitle');
        if (reviewTitleInput && movieTitle) {
            reviewTitleInput.value = `Review of ${movieTitle}`;
        }
    };

    // Function to close modal
    function closeReviewModalFunc() {
        reviewModal.classList.add('hidden');
        reviewModal.classList.remove('flex');
        document.body.style.overflow = '';
        resetReviewForm();
    }

    if (closeReviewModal) {
        closeReviewModal.addEventListener('click', closeReviewModalFunc);
    }

    if (cancelReview) {
        cancelReview.addEventListener('click', closeReviewModalFunc);
    }

    // Close modal on outside click
    reviewModal.addEventListener('click', (e) => {
        if (e.target === reviewModal) {
            closeReviewModalFunc();
        }
    });

    // Rating stars functionality
    if (ratingStars) {
        ratingStars.forEach(star => {
            star.addEventListener('click', () => {
                const value = parseInt(star.getAttribute('data-value'));
                selectedRating.value = value;
                ratingValue.textContent = `${value}/10`;

                // Update star display
                ratingStars.forEach(s => {
                    if (parseInt(s.getAttribute('data-value')) <= value) {
                        s.textContent = '★';
                        s.classList.add('active');
                        s.style.color = '#f5c518';
                    } else {
                        s.textContent = '☆';
                        s.classList.remove('active');
                        s.style.color = '';
                    }
                });
            });

            // Add hover effect
            star.addEventListener('mouseover', () => {
                const value = parseInt(star.getAttribute('data-value'));
                ratingStars.forEach(s => {
                    if (parseInt(s.getAttribute('data-value')) <= value) {
                        s.style.color = '#f5c518';
                    }
                });
            });

            star.addEventListener('mouseout', () => {
                const currentValue = parseInt(selectedRating.value);
                ratingStars.forEach(s => {
                    const starValue = parseInt(s.getAttribute('data-value'));
                    if (starValue > currentValue) {
                        s.style.color = '';
                    } else if (currentValue > 0) {
                        s.style.color = '#f5c518';
                    }
                });
            });
        });
    }

    // Review form submission
    if (reviewForm) {
        reviewForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const rating = selectedRating.value;
            const title = document.getElementById('reviewTitle').value;
            const content = document.getElementById('reviewContent').value;

            if (rating === '0') {
                alert('Please select a rating');
                return;
            }

            if (!title.trim()) {
                alert('Please enter a review title');
                return;
            }

            if (!content.trim()) {
                alert('Please enter your review content');
                return;
            }

            // Show success message (tanpa notifikasi "127.00 says")
            alert('Thank you for your review! It has been submitted successfully.');

            // Close modal
            closeReviewModalFunc();
        });
    }

    function resetReviewForm() {
        if (reviewForm) reviewForm.reset();
        if (selectedRating) selectedRating.value = '0';
        if (ratingValue) ratingValue.textContent = 'Select rating';
        if (ratingStars) {
            ratingStars.forEach(star => {
                star.textContent = '☆';
                star.classList.remove('active');
                star.style.color = '';
            });
        }
    }
}

// ===== ATTACH EVENT LISTENERS TO RATE BUTTONS =====

function attachRateButtonListeners() {
    // Attach event listeners to rate buttons in watchlist
    const rateButtons = document.querySelectorAll('.btn-rate');
    rateButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const card = this.closest('.card-dark');
            const movieId = card.dataset.id || null;
            const movieTitle = card.querySelector('.movie-title')?.textContent || 'Movie';
            
            if (window.openReviewModalWatchlist) {
                window.openReviewModalWatchlist(movieId, movieTitle);
            }
        });
    });
}

// ===== WATCHLIST FUNCTIONS =====

function loadWatchlistItems() {
    const listWrapper = document.getElementById('listWrapper');
    if (!listWrapper) return;
    
    let watchlistHTML = '';
    
    watchlistData.forEach(item => {
        watchlistHTML += `
            <article class="card-dark border border-neutral-800 rounded-lg overflow-hidden hover:border-neutral-700 transition-colors" 
                     data-id="${item.id}" 
                     data-title="${item.title}" 
                     data-year="${item.year}" 
                     data-rating="${item.rating}">
                <div class="p-4">
                    <div class="flex gap-4 items-start">
                        <!-- Poster -->
                        <div class="relative flex-none w-20">
                            <img src="${item.poster}"
                                 alt="${item.title} poster" 
                                 class="w-20 h-28 object-cover rounded-sm cursor-pointer">
                            <div class="corner-ribbon hidden absolute -left-2 -top-2 w-10 h-10 flex items-center justify-center rounded-br-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-black" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 6.707 9.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h3 class="text-xl font-semibold text-white">${item.position}. ${item.title}</h3>
                                    <div class="text-sm text-neutral-400 mt-2">
                                        <span class="mr-3">${item.year}</span>
                                        <span class="mr-3">${item.duration}</span>
                                        <span class="mr-3">SU</span>
                                        <span class="ml-2 inline-block px-2 py-0.5 bg-[#3fa93f] text-black rounded text-xs font-semibold">${item.score}</span>
                                    </div>
                                </div>

                                <div class="text-right flex flex-col items-end gap-3">
                                    <div class="flex items-center gap-2 text-sm text-neutral-200">
                                        <span class="text-yellow-400">★</span>
                                        <span class="font-semibold">${item.rating}</span>
                                        <span class="text-xs text-neutral-400">(${item.votes})</span>
                                    </div>

                                    <div class="flex items-center gap-3 text-sm">
                                        <button class="text-blue-400 hover:text-blue-300 btn-rate transition-colors">★ Rate</button>
                                        <button class="text-blue-400 hover:text-blue-300 btn-mark transition-colors">👁 Mark as watched</button>
                                        <button class="btn-info text-blue-400 hover:text-blue-300 transition-colors" title="Info">ⓘ</button>
                                    </div>
                                </div>
                            </div>

                            <p class="text-neutral-300 mt-3 leading-relaxed text-sm">
                                ${item.description}
                            </p>

                            <div class="mt-3 text-sm text-neutral-300">
                                <strong class="text-neutral-200">Directors</strong>
                                ${item.directors.map(director => 
                                    `<a href="#" class="text-blue-400 hover:underline ml-2">${director}</a>`
                                ).join('')}

                                <div class="mt-2">
                                    <strong class="text-neutral-200">Stars</strong>
                                    ${item.stars.map(star => 
                                        `<a href="#" class="text-blue-400 hover:underline ml-2">${star}</a>`
                                    ).join('')}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        `;
    });
    
    listWrapper.innerHTML = watchlistHTML;
    
    // Attach rate button listeners after loading items
    attachRateButtonListeners();
    
    // Update count
    updateCount();
}

function loadUserLists() {
    const userListsContainer = document.getElementById('user-lists');
    if (!userListsContainer) return;
    
    let listsHTML = '';
    
    userListsData.forEach(list => {
        const iconSVG = getListIcon(list.icon);
        
        listsHTML += `
            <a href="#" class="list-card">
                <div class="pr-3">
                    <div class="font-semibold text-white">${list.name}</div>
                    <div class="text-sm text-neutral-400 mt-1">${list.updated}</div>
                </div>
                <div class="w-14 h-14 bg-neutral-800 rounded-md flex items-center justify-center text-neutral-500 flex-shrink-0">
                    ${iconSVG}
                </div>
            </a>
        `;
    });
    
    userListsContainer.innerHTML = listsHTML;
}

function getListIcon(iconType) {
    switch(iconType) {
        case 'person':
            return `
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zm0 2c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z"/>
                </svg>
            `;
        case 'heart':
            return `
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            `;
        default:
            return `
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                </svg>
            `;
    }
}

// ===== EDIT MODE =====

function initializeEditMode() {
    const editBtn = document.getElementById('editBtn');
    const listWrapper = document.getElementById('listWrapper');
    
    if (!editBtn || !listWrapper) return;
    
    editBtn.addEventListener('click', () => {
        const isEditing = editBtn.classList.toggle('editing');
        editBtn.textContent = isEditing ? 'Done' : 'Edit';
        
        // Visual cue: dashed outline while editing
        document.querySelectorAll('.card-dark').forEach(card => {
            card.style.outline = isEditing ? '1px dashed rgba(165, 180, 252, 0.3)' : '';
            card.style.outlineOffset = isEditing ? '2px' : '';
        });
    });
}

// ===== CREATE MODAL =====

function initializeCreateModal() {
    const openCreateTop = document.getElementById('openCreateTop');
    const createModal = document.getElementById('create-list-modal');
    const cancelCreate = document.getElementById('cancelCreate');
    const confirmCreate = document.getElementById('confirmCreate');
    const newListName = document.getElementById('newListName');
    
    if (!openCreateTop || !createModal) return;
    
    function openCreateModal() {
        createModal.classList.remove('hidden');
        if (newListName) newListName.focus();
    }
    
    function closeCreateModal() {
        createModal.classList.add('hidden');
        if (newListName) newListName.value = '';
    }
    
    openCreateTop.addEventListener('click', openCreateModal);
    
    if (cancelCreate) {
        cancelCreate.addEventListener('click', closeCreateModal);
    }
    
    if (confirmCreate) {
        confirmCreate.addEventListener('click', () => {
            const name = (newListName && newListName.value.trim()) || 'Untitled list';
            showNotification(`Created list: "${name}" (frontend-only demo)`);
            closeCreateModal();
            
            // Add to user lists
            addNewUserList(name);
        });
    }
    
    createModal.addEventListener('click', (e) => {
        if (e.target === createModal) {
            closeCreateModal();
        }
    });
    
    // Escape key to close modal
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !createModal.classList.contains('hidden')) {
            closeCreateModal();
        }
    });
}

function addNewUserList(name) {
    const userListsContainer = document.getElementById('user-lists');
    if (!userListsContainer) return;
    
    const newList = {
        name: name.toLowerCase(),
        updated: "updated just now",
        icon: "default"
    };
    
    const iconSVG = getListIcon('default');
    
    const listHTML = `
        <a href="#" class="list-card">
            <div class="pr-3">
                <div class="font-semibold text-white">${newList.name}</div>
                <div class="text-sm text-neutral-400 mt-1">${newList.updated}</div>
            </div>
            <div class="w-14 h-14 bg-neutral-800 rounded-md flex items-center justify-center text-neutral-500 flex-shrink-0">
                ${iconSVG}
            </div>
        </a>
    `;
    
    userListsContainer.insertAdjacentHTML('afterbegin', listHTML);
}

// ===== INFO MODAL =====

function initializeInfoModal() {
    const listWrapper = document.getElementById('listWrapper');
    const infoModal = document.getElementById('info-modal');
    const infoBody = document.getElementById('infoBody');
    const infoTitle = document.getElementById('infoTitle');
    const closeInfo = document.getElementById('closeInfo');
    
    if (!listWrapper || !infoModal) return;
    
    listWrapper.addEventListener('click', (e) => {
        if (e.target.classList.contains('btn-info') || 
            e.target.closest('.btn-info')) {
            e.preventDefault();
            const card = e.target.closest('.card-dark');
            if (!card) return;
            
            const title = card.dataset.title || card.querySelector('h3')?.innerText || 'Title';
            const year = card.dataset.year || '';
            const rating = card.dataset.rating || '';
            const desc = card.querySelector('p')?.innerText || '';
            
            infoTitle.textContent = title;
            infoBody.innerHTML = `
                <p class="text-sm mb-2"><strong>Year:</strong> ${year} • <strong>Rating:</strong> ${rating}/10</p>
                <p class="mb-4">${desc}</p>
                <p class="text-xs text-neutral-400">This is a demo info modal. In a real app, this would show more detailed information about the movie.</p>
            `;
            infoModal.classList.remove('hidden');
        }
    });
    
    if (closeInfo) {
        closeInfo.addEventListener('click', () => {
            infoModal.classList.add('hidden');
        });
    }
    
    infoModal.addEventListener('click', (e) => {
        if (e.target === infoModal) {
            infoModal.classList.add('hidden');
        }
    });
    
    // Escape key to close modal
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !infoModal.classList.contains('hidden')) {
            infoModal.classList.add('hidden');
        }
    });
}

// ===== SORTING =====

function initializeSorting() {
    const sortSelect = document.getElementById('sortSelect');
    const listWrapper = document.getElementById('listWrapper');
    
    if (!sortSelect || !listWrapper) return;
    
    sortSelect.addEventListener('change', () => {
        const option = sortSelect.value;
        const items = Array.from(listWrapper.querySelectorAll('.card-dark'));
        
        switch(option) {
            case 'title':
                items.sort((a, b) => (a.dataset.title || '').localeCompare(b.dataset.title || ''));
                break;
            case 'year':
                items.sort((a, b) => parseInt(b.dataset.year || 0) - parseInt(a.dataset.year || 0));
                break;
            case 'rating':
                items.sort((a, b) => parseFloat(b.dataset.rating || 0) - parseFloat(a.dataset.rating || 0));
                break;
            case 'list':
            default:
                // Keep original order based on data-id
                items.sort((a, b) => parseInt(a.dataset.id || 0) - parseInt(b.dataset.id || 0));
                break;
        }
        
        // Update numbering and reorder
        items.forEach((item, index) => {
            const titleEl = item.querySelector('h3');
            if (titleEl) {
                const titleText = titleEl.textContent.replace(/^\d+\.\s*/, '');
                titleEl.textContent = `${index + 1}. ${titleText}`;
            }
            listWrapper.appendChild(item);
        });
    });
}

// ===== WATCHLIST ACTIONS =====

function initializeWatchlistActions() {
    const listWrapper = document.getElementById('listWrapper');
    if (!listWrapper) return;
    
    // Poster ribbon toggle
    listWrapper.addEventListener('click', (e) => {
        if (e.target.tagName === 'IMG' && e.target.classList.contains('rounded-sm')) {
            const ribbon = e.target.closest('.relative').querySelector('.corner-ribbon');
            if (!ribbon) return;
            ribbon.classList.toggle('hidden');
        }
    });
    
    // Mark as watched button
    listWrapper.addEventListener('click', (e) => {
        if (e.target.classList.contains('btn-mark') || 
            e.target.closest('.btn-mark')) {
            e.preventDefault();
            const btn = e.target.classList.contains('btn-mark') ? e.target : e.target.closest('.btn-mark');
            const card = btn.closest('.card-dark');
            const title = card.dataset.title || 'Item';
            const currentText = btn.textContent.trim();
            
            if (currentText.includes('Mark as watched')) {
                btn.textContent = '✓ Watched';
                btn.classList.remove('text-blue-400');
                btn.classList.add('text-green-400');
                
                // Add visual indicator
                const ribbon = card.querySelector('.corner-ribbon');
                if (ribbon) ribbon.classList.remove('hidden');
                
                showNotification(`${title} marked as watched`);
            } else {
                btn.textContent = '👁 Mark as watched';
                btn.classList.remove('text-green-400');
                btn.classList.add('text-blue-400');
                
                // Remove visual indicator
                const ribbon = card.querySelector('.corner-ribbon');
                if (ribbon) ribbon.classList.add('hidden');
                
                showNotification(`${title} marked as unwatched`);
            }
        }
    });
}

// ===== HELPER FUNCTIONS =====

function updateCount() {
    const countText = document.getElementById('countText');
    const listWrapper = document.getElementById('listWrapper');
    
    if (countText && listWrapper) {
        const n = listWrapper.querySelectorAll('.card-dark').length;
        countText.textContent = `${n} titles`;
    }
}

function showNotification(message) {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = 'fixed top-4 right-4 bg-[#0f0f0f] border border-neutral-800 text-white px-4 py-3 rounded-lg shadow-lg z-50 transition-all duration-300 transform translate-y-[-20px] opacity-0';
    notification.textContent = message;
    notification.style.maxWidth = '300px';
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateY(0)';
        notification.style.opacity = '1';
    }, 10);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.transform = 'translateY(-20px)';
        notification.style.opacity = '0';
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

// ===== EXPORT FUNCTIONS =====

window.WatchlistReview = {
    initializeReviewModalWatchlist,
    attachRateButtonListeners
};

window.Watchlist = {
    loadWatchlistItems,
    loadUserLists,
    initializeEditMode,
    initializeCreateModal,
    initializeInfoModal,
    initializeSorting,
    initializeWatchlistActions,
    updateCount,
    showNotification
};