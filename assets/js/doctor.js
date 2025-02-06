// Get the Back to Top button element
const backToTopButton = document.getElementById("backToTop");
const whatsappButton = document.querySelector(".whatsapp-button");

// Check if the device is mobile
const isMobile = window.innerWidth < 768; // Adjust breakpoint as needed (768px is typical for tablets/mobiles)

// Initially hide the WhatsApp button on mobile
if (isMobile) {
    whatsappButton.classList.remove("show"); // Remove class to hide WhatsApp button with slide-down and fade-out effect
} else {
    whatsappButton.classList.add("show"); // Add class to show WhatsApp button with slide-up and fade-in effect
}

// Scroll event handler
window.onscroll = function () {
    const backToTopThreshold = isMobile ? 1470 : 970; // Threshold for Back to Top button
    const whatsappThreshold = isMobile ? 20 : 0; // WhatsApp threshold (only on mobile)

    // Back to Top button visibility
    if (document.body.scrollTop > backToTopThreshold || document.documentElement.scrollTop > backToTopThreshold) {
        backToTopButton.classList.add("show"); // Add class to show button with fade-in effect
    } else {
        backToTopButton.classList.remove("show"); // Remove class to hide button with fade-out effect
    }

    // WhatsApp button visibility (only for mobile)
    if (isMobile) {
        if (document.body.scrollTop > whatsappThreshold || document.documentElement.scrollTop > whatsappThreshold) {
            whatsappButton.classList.add("show"); // Add class to show WhatsApp button with slide-up and fade-in effect
        } else {
            whatsappButton.classList.remove("show"); // Remove class to hide WhatsApp button with slide-down and fade-out effect
        }
    }
};

// Scroll back to top when the Back to Top button is clicked
backToTopButton.onclick = function () {
    window.scrollTo({
        top: 0,
        behavior: "smooth" // Smooth scrolling
    });
};


// Function to toggle the mobile menu
function toggleMenu() {
    var mobileNav = document.getElementById("mobileNav");
    mobileNav.classList.toggle("open");
}
