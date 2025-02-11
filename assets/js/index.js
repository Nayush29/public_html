const treatmentItems = [
    {
        title: "Infertility",
        description: "Infertility is a common tragedy that affects many couples worldwide....",
        imageUrl: "assets/img/BANNER/7.jpeg",
        pageUrl: "/Treatment/Male-and-Female-Infertility-Treatment.html"
    },
    {
        title: "Arthritis",
        description: "Arthritis is a common joint disorder that affects millions of people worldwide....",
        imageUrl: "assets/img/BANNER/4.jpeg",
        pageUrl: "/Treatment/Joint-and-Spine-Care.html"
    },
    {
        title: "Diabetes",
        description: "Diabetes is a chronic metabolic disorder that affects millions of people worldwide....",
        imageUrl: "assets/img/BANNER/5.jpeg",
        pageUrl: "/Treatment/Digestive-Care.html"  // Added page URL
    },
    {
        title: "Migraine",
        description: "Migraine is a common neurological disorder that affects millions of people worldwide...",
        imageUrl: "assets/img/BANNER/3.jpeg",
        pageUrl: "/Treatment/Neuro-Ortho-Care-by-Dr.Arvind-Chaudhry.html"  // Added page URL
    },
    {
        title: "Piles, Fissure & Fistula",
        description: "Piles, also known as hemorrhoids, are swollen and inflamed veins located in the lower part of the rectum and anus....",
        imageUrl: "assets/img/BANNER/8.jpeg",
        pageUrl: "/Treatment/Anorectal-Piles-Care.html"  // Added page URL
    },
    {
        title: "Spinal Sickness",
        description: "Spinal sickness is a common term for various conditions affecting the spinal column....",
        imageUrl: "assets/img/BANNER/6.jpeg",
        pageUrl: "/Treatment/Joint-and-Spine-Care.html"  // Added page URL
    },
    {
        title: "Cancer",
        description: "Cancer is a disease characterized by the uncontrolled growth and spread of abnormal cells in the body...",
        imageUrl: "assets/img/BANNER/1.jpeg",
        pageUrl: "/Treatment/Cancer.html"  // Added page URL
    },
    {
        title: "Cardiac Conditions",
        description: "Cardiac conditions refer to various heart-related diseases, including heart attacks, arrhythmias, and more...",
        imageUrl: "assets/img/BANNER/2.jpeg",
        pageUrl: "/Treatment/Cardiac-Disease.html"  // Added page URL
    }
];

const medicalGalleryItems = [];
for (let i = 1; i <= 91; i++) {
    medicalGalleryItems.push({
        title: 'Ayurvedic Hospital in Dehradun',
        imageUrl: `assets/img/gallary/${i}.png`
    });
}

const testimonialsItems = [
    {
        quote: 'Mr. Akshay is our patient who just recovered from a deadly disease- Covid 19. Listen to what he is saying.',
        author: 'Mr. Akshay'
    },
    {
        quote: 'I am only having one kidney. For some time I was suffering from High creatinine levels and High Blood pressure. I visited Dr. Arvind Chaudhary at Ayurmax hospital who diagnosed me having critical levels of creatinine. I underwent treatment for one month at Ayurmax. I got relief from all the uneasiness with care and treatment from Dr. Arvind. I would say he is my life-saver.',
        author: 'Rahul Joshi'
    },
    {
        quote: 'My recent experience with Dr. Rekha Chaudhary at Ayurmax Hospital was exceptional. After 4.5 years of marriage, I\'m now 8 weeks pregnant, and Dr. Chaudhary\'s expertise and compassion were crucial. The clinic\'s welcoming atmosphere, her 24x7 dedication, and effective communication make her the ideal choice for women\'s healthcare. Highly recommended for comprehensive and advanced gynecological care.',
        author: 'Anjana Sharma'
    },
    {
        quote: 'I am Ravinder, 56 years of age, and employed in MES. I was afflicted with intense disc problems for a long time and was unable to move around or sit easily. I visited reputed surgeons in Dehradun but found no relief from the treatment. To get the relief I further consulted government neurosurgeons only to be disappointed and my pain lingered on. Seeing no improvement in my intense pain, one of my colleagues suggested me to visit Dr. Arvind of Ayurmax hospital. At first, I was skeptical about the treatment. But to my pleasant surprise, he diagnosed my disc problem comprehensively. The consultation session was very detailed where he went through my case history and then initiated the treatment. The therapy and treatment administered alleviated my pain completely. The cooperative medical staff and doctors at Ayurmax helped me recover from the long-associated Disc ailment. During my stay at Ayurmax for my treatment, I was attended well by the Ayurmax staff and every issue was taken care of without any delay. The treatment and medications helped me regain my health and I can move and sit at ease without any trace of pain. Thus, I would recommend Ayurmax to anyone facing serious ailments for a long time. Now I have rejoined my duty at MES in healthy shape.',
        author: 'Ravinder, 56 years of age, MES Employee'
    },
    {
        quote: 'My 3 years old daughter Gauranshi had immunity weakness in her body since 6 months of age. I was worried as she would frequently fall ill due to her weak resistance against all kinds of flues. We had to frequently visit doctors with her. But still, there was no permanent resolution in sight. Then I got to know about Ayurvedic treatment for immunity related issues. I have heard that Dr. Rekha of Ayurmax hospital has been treating children with permanent relief. I visited Ayurmax where Dr. Rekha introduced the gem of Ayurveda- swarnaprashan (Gold consumption as an ayurvedic medication). With regular immunizing sessions, I witnessed a gradual improvement in my daughter’s immunity. With monthly visits, there was a sea-change in her health. Also, her memory and personality improved a lot. Now she has an immense change in her health in comparison to children of her age. I will remain thankful to Dr. Rekha for my daughter’s treatment and bringing back the cheerfulness of Gauranshi.',
        author: 'Gauranshi’s Mother'
    },
    {
        quote: 'My wife has been suffering from stomach cancer in 2014. We went to Chandigarh for its treatment where her critical ailment was operated on. But the post-surgery treatment after the surgery was not attended well by the Chandigarh hospital. The pain and unease due to surgery did not go away completely. One of our relatives suggested ayurvedic treatment for prolonged relief. Fortunately, we came to know about Dr. Arvind Chaudhary, chief surgeon at Ayurmax. He understood my wife’s case history and subsequently started post-surgery recovery treatment. Today, I am relieved that my wife has completely recovered and is healthy. The treatment and medical staff communication were very effective to help my wife regain her health.',
        author: 'Mr. and Mrs. Dayal Singh'
    },
    {
        quote: 'Over the last 1.5 years, I was suffering from a whole lot of health problems like Irregular menstrual periods, face acne, and hair fall. Someone known to me asked me to once visit Dr. Rekha Chaudhary in Ayurmax hospital. She diagnosed me and found me affected by PCOD disease. The treatment by Dr. Rekha helped me heal completely within 7 months without any trace of side-effects. The best facilities and caring attitude of all the staff are unmatched. Now I am pregnant with a baby and I found it best to visit only Ayurmax for all prenatal care and pregnancy tests.',
        author: 'Priyanka Bhatt'
    },
    {
        quote: 'I was referred from Swami Subhodanand of Achlamai to visit Ayurmax. After a thorough investigation, I was given treatment for my backbone related ailment by Dr. Arvind. I was admitted for therapeutic healing procedures to treat my illness. His polite nature and interaction was a positive experience. The treatment methodology of Kativasthi, januvasta, Naina, and Dr. Anjali healed my backbone pain gradually. I have also undergone Agnikarma, hair spa, and facial treatment as well from Dr. Preeti Chaudhary after having a pleasant experience with backbone treatment. During our 20 days stay at Ayurmax hospital, there was a home-like atmosphere with all staff very helpful and always attended whenever we needed anything. Staff members like Arjun, Laxman, and Dharamveer were extremely helpful. Timely doctor visits, personalized treatment care, and polite nature was a touching highlight of our experience.',
        author: 'Savita Kayal'
    },
    {
        quote: 'Our baby is 6 months old and we have been giving our baby Swarnaprashana for the last 3 months. We got to know about Swarnaprashana from our family friends Dr. Hema and Shyam Sunder Parmar. They asked us to visit Ayurmax. We were initially under the impression that it is an immunity booster vaccine. But on getting in touch with Dr. Rekha Chaudhary at Ayurmax we got to know the comprehensive benefits for our baby like brain development and mental health, initial tooth issues. On seeing the benefits of Swarnaprashana we also gave our baby Nityaprashan on the recommendation of Dr. Rekha Chaudhary. We saw positive changes in our child in form of increased daily activity and the baby is more active, safe against diseases, and learning new things faster than other kids.',
        author: 'Father of 6 months old baby, Dr. Aditya, a scientist at Wadia Institute of Geology'
    },
    {
        quote: 'I heard about Swarnaprashan 3 years before. My daughter Parisha had been physically weak and had digestive problems. She was also suffering from dysentery, vomiting, and diarrhea whenever she ate anything. Due to this, she was very dull and lazy. I visited the allopathic doctor for addressing this problem. He diagnosed my daughter as lactose intolerant so milk and milk-product consumption were stopped. On recommendation from neighbors and family friends, I visited Ayurmax for this physical deficiency. Dr. Rekha Chaudhary at Ayurmax was a helpful doctor and administered Swarnaprashan to my daughter. After the treatment, I am happy that my daughter is now energetic, digestion is good, better at remembering things, and overall health is much improved than before. The teachers at my daughter’s school are also happy for her performance in class and overall positive outlook. I would recommend Swarnaprashan to other parents for their kids health and personality.',
        author: 'Rashi Arora, mother of a 10-year-old Parisha'
    }
];


// Current Indices for the Carousels
let carouselIndices = {
    Treatment: 0,
    MedicalGallery: 0,
    Testimonials: 0
};

// Carousel Data Mapping
const carouselData = {
    Treatment: { items: treatmentItems, contentId: 'treatment-carousel-content' },
    MedicalGallery: { items: medicalGalleryItems, contentId: 'medical-gallery-carousel-content' },
    Testimonials: { items: testimonialsItems, contentId: 'testimonials-carousel-content' }
};

// Preload images for all carousels
function preloadImages() {
    [...treatmentItems, ...medicalGalleryItems].forEach(item => {
        const img = new Image();
        img.src = item.imageUrl;
    });
}

preloadImages();

// Update Carousel Content (Shared Function)
function updateCarouselContent(type) {
    const { items, contentId } = carouselData[type];
    const currentIndex = carouselIndices[type];
    const carouselContent = document.getElementById(contentId);

    carouselContent.innerHTML = ''; // Clear current content

    if (type === 'Treatment') {
        const currentItem = items[currentIndex];
        const carouselItem = createElement('div', { class: 'carousel-item', style: `background-image: url(${currentItem.imageUrl})` });

        // Create a div for the title and description
        const itemTitleDiv = createElement('div', { class: 'item-title-container' });
        const itemTitle = createElement('h3', {}, currentItem.title);
        const description = createElement('p', {}, currentItem.description);

        itemTitleDiv.append(itemTitle, description);

        // Create "Know More" and "Book Now" buttons
        const knowMoreButton = createElement('a', { href: `${currentItem.pageUrl}`, class: 'carousel-button know-more-button' }, 'Know More');
        const bookNowButton = createElement('a', { href: 'appointment.html', class: 'carousel-button book-appointment-btn' }, 'Book Appointment');

        // Append the buttons to the itemTitleDiv
        itemTitleDiv.append(knowMoreButton, bookNowButton);

        // Append everything to the carouselItem
        carouselItem.appendChild(itemTitleDiv);

        // Append the carouselItem to the carouselContent
        carouselContent.appendChild(carouselItem);

    } else if (type === 'MedicalGallery') {
        // Determine how many items to display based on device width
        const itemsToShow = window.innerWidth <= 768 ? 2 : 4;

        for (let i = 0; i < itemsToShow; i++) {
            const currentItem = items[(currentIndex + i) % items.length];
            const carouselItem = createElement('div', { class: 'mg-carousel-item' });
            const image = createElement('img', { src: currentItem.imageUrl, alt: currentItem.title });
            carouselItem.appendChild(image);
            carouselContent.appendChild(carouselItem);
        }
    } else if (type === 'Testimonials') {

        for (let i = 0; i < 1; i++) {
            const currentItem = items[(currentIndex + i) % items.length];
            const carouselItem = createElement('div', { class: 'testimonial-item' });
            const quote = createElement('blockquote', { class: 'testimonial-quote' }, currentItem.quote);
            const author = createElement('p', { class: 'testimonial-author' }, `- ${currentItem.author}`);
            carouselItem.append(quote, author);
            carouselContent.appendChild(carouselItem);
        }
    }
}

// Utility function to create elements
function createElement(tag, attributes = {}, textContent = '') {
    const element = document.createElement(tag);
    Object.entries(attributes).forEach(([key, value]) => element.setAttribute(key, value));
    if (textContent) element.textContent = textContent;
    return element;
}

// Move Carousel (Shared Function)
function moveCarousel(type, direction) {
    const itemsLength = carouselData[type].items.length;
    carouselIndices[type] = (carouselIndices[type] + direction + itemsLength) % itemsLength;
    updateCarouselContent(type);
}

// Initialize all carousels
updateCarouselContent('Treatment');
updateCarouselContent('MedicalGallery');
updateCarouselContent('Testimonials');

// Set interval to update carousel content every 10 seconds
setInterval(() => {
    // Increment the indices to move to the next item for each carousel
    carouselIndices.Treatment = (carouselIndices.Treatment + 1) % treatmentItems.length;
    carouselIndices.MedicalGallery = (carouselIndices.MedicalGallery + 1) % medicalGalleryItems.length;
    carouselIndices.Testimonials = (carouselIndices.Testimonials + 1) % testimonialsItems.length;

    // Update each carousel content
    updateCarouselContent('Treatment');
    updateCarouselContent('MedicalGallery');
    updateCarouselContent('Testimonials');
}, 5000); // 10000 milliseconds = 10 seconds


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
    const backToTopThreshold = isMobile ? 1100 : 750; // Threshold for Back to Top button
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
    const mobileNav = document.getElementById("mobileNav");
    mobileNav.classList.toggle("open");
}
