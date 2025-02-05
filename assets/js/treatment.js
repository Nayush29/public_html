// Treatment items with added page URLs
const treatmentItems = [
  {
    title: "Infertility",
    description: "Infertility is a common tragedy that affects many couples worldwide....",
    imageUrl: "/assets/img/BANNER/7.jpeg",
    pageUrl: "/Treatment/Male-and-Female-Infertility-Treatment.html"
  },
  {
    title: "Arthritis",
    description: "Arthritis is a common joint disorder that affects millions of people worldwide....",
    imageUrl: "/assets/img/BANNER/4.jpeg",
    pageUrl: "/Treatment/Joint-and-Spine-Care.html"
  },
  {
    title: "Diabetes",
    description: "Diabetes is a chronic metabolic disorder that affects millions of people worldwide....",
    imageUrl: "/assets/img/BANNER/5.jpeg",
    pageUrl: "/Treatment/Digestive-Care.html"
  },
  {
    title: "Migraine",
    description: "Migraine is a common neurological disorder that affects millions of people worldwide...",
    imageUrl: "/assets/img/BANNER/3.jpeg",
    pageUrl: "/Treatment/Neuro-Ortho-Care-by-Dr.Arvind-Chaudhry.html"
  },
  {
    title: "Piles, Fissure & Fistula",
    description: "Piles, also known as hemorrhoids, are swollen and inflamed veins located in the lower part of the rectum and anus....",
    imageUrl: "/assets/img/BANNER/8.jpeg",
    pageUrl: "/Treatment/Anorectal-Piles-Care.html"
  },
  {
    title: "Spinal Sickness",
    description: "Spinal sickness is a common term for various conditions affecting the spinal column....",
    imageUrl: "/assets/img/BANNER/6.jpeg",
    pageUrl: "/Treatment/Joint-and-Spine-Care.html"
  },
  {
    title: "Cancer",
    description: "Cancer is a disease characterized by the uncontrolled growth and spread of abnormal cells in the body...",
    imageUrl: "/assets/img/BANNER/1.jpeg",
    pageUrl: "/Treatment/Cancer.html"
  },
  {
    title: "Cardiac Conditions",
    description: "Cardiac conditions refer to various heart-related diseases, including heart attacks, arrhythmias, and more...",
    imageUrl: "/assets/img/BANNER/2.jpeg",
    pageUrl: "/Treatment/Cardiac-Disease.html"
  }
];

const container = document.querySelector('.disease-container');

// Helper function to check if the current URL contains a treatment page
function getTreatmentFromUrl() {
  const currentUrl = window.location.pathname;

  // Loop through the treatment items to find if the URL matches any treatment's page URL
  for (let i = 0; i < treatmentItems.length; i++) {
    const treatment = treatmentItems[i];
    if (currentUrl.includes(treatment.pageUrl)) {
      return i;  // Return the index of the matched treatment
    }
  }
  return null;  // No match found, return null
}

let currentIndex = getTreatmentFromUrl() || 0;  // Set the initial index based on the URL treatment, or default to 0

function displayItem(index) {
  container.innerHTML = ''; // Clear previous content
  const item = treatmentItems[index];

  // Set the background image of the container
  container.style.backgroundImage = `url('${item.imageUrl}')`;

  const contentDiv = document.createElement('div');
  contentDiv.classList.add('disease-content');

  contentDiv.innerHTML = `
        <h3>${item.title}</h3>
        <p>${item.description}</p>
      `;

  container.appendChild(contentDiv);
}

function cycleItems() {
  displayItem(currentIndex);
  currentIndex = (currentIndex + 1) % treatmentItems.length;
}

// Display the first item immediately
cycleItems();

// Cycle through items every 5 seconds
setInterval(cycleItems, 5000);

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