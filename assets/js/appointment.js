$(document).ready(function () {
    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();
    let selectedDate = null;
    let formSubmitted = sessionStorage.getItem('formSubmitted') === 'true'; // Check if form has been submitted

    // Render the calendar
    const renderCalendar = () => {
        const today = new Date();
        const firstDay = new Date(currentYear, currentMonth).getDay();
        const lastDate = new Date(currentYear, currentMonth + 1, 0).getDate();
        let tableHTML = `
            <thead>
                <tr>
                    <th colspan="7">
                        <div class="calendar-nav">
                            <button id="prev-month" ${currentMonth === today.getMonth() && currentYear === today.getFullYear() ? 'disabled' : ''}>◀</button>
                            <span id="month-label">${months[currentMonth]} ${currentYear}</span>
                            <button id="next-month">▶</button>
                        </div>
                    </th>
                </tr>
                <tr>
                    ${["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"].map(day => `<th>${day}</th>`).join('')}
                </tr>
            </thead>
            <tbody><tr>`;

        for (let i = 0; i < firstDay; i++) {
            tableHTML += `<td></td>`;
        }

        for (let day = 1; day <= lastDate; day++) {
            const date = new Date(currentYear, currentMonth, day);
            const isPastDate = date < today.setHours(0, 0, 0, 0);
            const isSelected = selectedDate && selectedDate.getDate() === day && selectedDate.getMonth() === currentMonth && selectedDate.getFullYear() === currentYear;
            tableHTML += `<td class="day ${isSelected ? 'selected' : ''} ${isPastDate ? 'disabled' : ''}" data-day="${day}">${day}</td>`;
            if ((firstDay + day) % 7 === 0) tableHTML += `</tr><tr>`;
        }

        tableHTML += `</tr></tbody>`;
        $('#calendar').html(tableHTML);
    };

    // Handle month navigation
    $(document).on('click', '#prev-month', function () {
        if (currentMonth > 0 || currentYear > new Date().getFullYear()) {
            currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
            if (currentMonth === 11) currentYear--;
            renderCalendar();
        }
    });

    $(document).on('click', '#next-month', function () {
        currentMonth = (currentMonth === 11) ? 0 : currentMonth + 1;
        if (currentMonth === 0) currentYear++;
        renderCalendar();
    });

    // Handle day selection
    $(document).on('click', '.day', function () {
        if ($(this).hasClass('disabled')) {
            return; // Prevent selection of past dates
        }

        selectedDate = new Date(currentYear, currentMonth, $(this).data('day'));
        $('#appointment_selected').text(`${months[currentMonth]} ${selectedDate.getDate()}, ${currentYear}`);
        $('.day').removeClass('selected');
        $(this).addClass('selected');
    });

    // Handle Back to Home button click
    $('#back-to-form').on('click', function () {
        window.location.href = 'index.html'; // Redirect to home page
    });

    // Helper function to set text or hide elements
    const setTextOrHide = (selector, value) => {
        if (value && value !== 'N/A') {
            $(selector).text(value).closest('.overview-item').show();
        } else {
            $(selector).closest('.overview-item').hide();
        }
    };

    emailjs.init('iYDl8kymS68rUKpLT');

    // Handle form submission
    $('#appointment-form').on('submit', function (event) {
        event.preventDefault();

        // Prevent multiple submissions
        if (formSubmitted) {
            alert("You have already submitted an appointment.");
            return;
        }

        if (!selectedDate) {
            alert("Please select a date for the appointment.");
            return;
        }

        const doctor = $('#doctor').val();
        const name = $('#name').val();
        const phone = $('#phone').val();
        const description = $('#description').val();
        const patientStatus = $('#patient_status').val();
        const fileNumber = $('#file_number').val();
        const formattedDate = selectedDate.toLocaleDateString('en-IN', {
            year: 'numeric',
            month: 'numeric',
            day: 'numeric'
        });

        // Set text for overview items
        setTextOrHide('#doctor_selected', doctor);
        setTextOrHide('#name_selected', name);
        setTextOrHide('#phone_selected', phone);
        setTextOrHide('#description_selected', description);
        setTextOrHide('#status_selected', patientStatus);
        setTextOrHide('#file_selected', fileNumber);
        setTextOrHide('#date_selected', formattedDate);

        // Hide the form and show the overview
        $('#form-container').hide();
        $('#date-container').hide();
        $('#overview').show();

        // Send data via EmailJS
        emailjs.send('service_561yg8s', 'template_rx5b8zn', {
            doctor: doctor,
            name: name,
            phone: phone,
            description: description,
            patientStatus: patientStatus,
            fileNumber: fileNumber,
            formattedDate: formattedDate
        })
            .then(function (response) {
                alert('Appointment details have been sent.');
                formSubmitted = true; // Set flag to true after successful submission
                sessionStorage.setItem('formSubmitted', true); // Save submission state to sessionStorage
            }, function (error) {
                alert('An error occurred while sending: ' + JSON.stringify(error));
            });
    });

    renderCalendar(); // Initial render
});


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
