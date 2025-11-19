document.addEventListener("DOMContentLoaded", () => {
    console.log('All cookies:', document.cookie);
    
    const likeButtons = document.querySelectorAll(".like-btn");

    likeButtons.forEach(btn => {
        btn.addEventListener("click", async (e) => {
            e.preventDefault();
            
            const slug = btn.dataset.slug;
            const likesCounter = btn.parentElement.querySelector(".likes-count");
            const outlineIcon = btn.querySelector(".outline-icon");
            const filledIcon = btn.querySelector(".filled-icon");

            console.log('=== LIKE BUTTON CLICKED ===');
            console.log('Slug:', slug);

            try {
                const res = await fetch(`/layanan/${slug}/like`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Accept": "application/json",
                        "Content-Type": "application/json"
                    },
                    credentials: 'same-origin'
                });

                if (!res.ok) throw new Error('Network response was not ok');

                const data = await res.json();
                
                console.log('Response:', data);
                console.log('Debug info:', data.debug);

                // Update counter
                if (data.likes !== undefined) {
                    likesCounter.textContent = `${data.likes} likes`;
                }

                // Toggle icons
                if (data.liked) {
                    console.log('Setting to LIKED state');
                    outlineIcon.classList.remove("opacity-100", "scale-100", "group-hover/like:opacity-0", "group-hover/like:scale-75");
                    outlineIcon.classList.add("opacity-0", "scale-75");
                    
                    filledIcon.classList.remove("opacity-0", "scale-75", "group-hover/like:opacity-100", "group-hover/like:scale-100");
                    filledIcon.classList.add("opacity-100", "scale-100");
                    
                    btn.classList.add("text-red-600");
                    btn.classList.remove("text-[#0F044C]");
                } else {
                    console.log('Setting to UNLIKED state');
                    outlineIcon.classList.remove("opacity-0", "scale-75");
                    outlineIcon.classList.add("opacity-100", "scale-100", "group-hover/like:opacity-0", "group-hover/like:scale-75");
                    
                    filledIcon.classList.remove("opacity-100", "scale-100");
                    filledIcon.classList.add("opacity-0", "scale-75", "group-hover/like:opacity-100", "group-hover/like:scale-100");
                    
                    btn.classList.remove("text-red-600");
                    btn.classList.add("text-[#0F044C]");
                }

            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            }
        });
    });
});