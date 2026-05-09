<?php
$pageTitle = 'Passenger Information - MetroBus Johannesburg';
require_once 'includes/header.php';
?>
<main>
    <section class="container mt-3">
<h1>Passenger Information</h1>
    <p>Everything you need to know about traveling with MetroBus.</p>
    <div class="card">
<h2>How to Use MetroBus</h2>
    <div class="accordion">
    <div class="accordion-item">
    <button class="accordion-header" onclick="toggleAccordion(this)">
    <span>Buying a Ticket</span>
    <span class="accordion-icon">+</span>
    </button>
    <div class="accordion-content">
<p>You can buy tickets in several ways:</p>
    <ul>
    <li><strong>Cash:</strong> Pay the driver directly when boarding</li>
    <li><strong>MetroCard:</strong> Prepaid card available at stations</li>
    <li><strong>Mobile App:</strong> Use our app for contactless payment</li>
    <li><strong>Online:</strong> Purchase tickets on our website</li>
    </ul>
<p>Exact change is appreciated when paying cash.</p>
    </div>
    </div>
    <div class="accordion-item">
    <button class="accordion-header" onclick="toggleAccordion(this)">
    <span>Finding Your Bus Stop</span>
    <span class="accordion-icon">+</span>
    </button>
    <div class="accordion-content">
    <p>Bus stops are clearly marked with MetroBus signage. You can:</p>
    <ul>
    <li>Use our route finder on the website</li>
    <li>Check the MetroBus app for nearby stops</li>
    <li>Call our helpline for assistance</li>
    <li>Ask station staff for directions</li>
    </ul>
    </div>
    </div>
    <div class="accordion-item">
    <button class="accordion-header" onclick="toggleAccordion(this)">
    <span>Boarding the Bus</span>
    <span class="accordion-icon">+</span>
    </button>
    <div class="accordion-content">
    <p>When boarding:</p>
    <ul>
    <li>Wait for the bus to come to a complete stop</li>
    <li>Board through the front door</li>
    <li>Pay your fare immediately</li>
    <li>Find a seat or hold on to a pole</li>
    <li>Move to the rear of the bus to allow others to board</li>
    </ul>
    </div>
    </div>
    </div>
    </div>
<div class="card mt-3">
    <h2>Safety Guidelines</h2>
    <div class="grid grid-2">
    <div>
    <h3>On the Bus</h3>
    <ul>
    <li>Always hold on while the bus is moving</li>
    <li>Keep aisles clear</li>
    <li>Be courteous to other passengers</li>
    <li>Report any suspicious behavior</li>
    <li>Keep personal belongings secure</li>
    </ul>
    </div>
    <div>
    <h3>At Bus Stops</h3>
    <ul>
    <li>Stand back from the curb</li>
    <li>Wait in designated areas</li>
    <li>Be aware of your surroundings</li>
    <li>Don't block the sidewalk</li>
    <li>Help elderly or disabled passengers</li>
    </ul>
    </div>
    </div>
    </div>
<div class="card mt-3">
    <h2>Accessibility Information</h2>
    <div class="grid grid-2">
    <div>
    <h3>Wheelchair Access</h3>
    <p>All MetroBus vehicles are equipped with wheelchair lifts and securement areas.</p>
    <ul>
    <li>Request assistance from the driver</li>
    <li>Wheelchair spaces are available on all buses</li>
    <li>Priority seating for disabled passengers</li>
    </ul>
    </div>
    <div>
<h3>Visual and Hearing Impaired</h3>
<p>We provide services for passengers with visual or hearing impairments.</p>
    <ul>
    <li>Audio announcements at major stops</li>
    <li>Braille signage on buses and stops</li>
    <li>Assistance dogs welcome</li>
    <li>Priority boarding for visually impaired</li>
    </ul>
    </div>
    </div>
    </div>
<div class="card mt-3">
    <h2>Frequently Asked Questions</h2>
    <div class="accordion">
    <div class="accordion-item">
    <button class="accordion-header" onclick="toggleAccordion(this)">
    <span>What are the operating hours?</span>
    <span class="accordion-icon">+</span>
    </button>
    <div class="accordion-content">
<p>MetroBus operates from 5:00 AM to 11:00 PM Monday to Saturday, and 6:00 AM to 10:00 PM on Sundays and public holidays.</p>
    </div>
    </div>
    <div class="accordion-item">
    <button class="accordion-header" onclick="toggleAccordion(this)">
    <span>How do I report lost items?</span>
    <span class="accordion-icon">+</span>
    </button>
    <div class="accordion-content">
<p>Contact our lost and found department at any major station or call our helpline. Items are kept for 30 days.</p>
    </div>
    </div>
    <div class="accordion-item">
    <button class="accordion-header" onclick="toggleAccordion(this)">
    <span>Can I bring pets on the bus?</span>
    <span class="accordion-icon">+</span>
    </button>
    <div class="accordion-content">
<p>Small pets in carriers are allowed. Service animals are always welcome. No other animals permitted.</p>
    </div>
    </div>
    <div class="accordion-item">
    <button class="accordion-header" onclick="toggleAccordion(this)">
    <span>What should I do if I miss my stop?</span>
    <span class="accordion-icon">+</span>
    </button>
    <div class="accordion-content">
<p>Inform the driver immediately. You can get off at the next stop and catch a bus going back, or transfer to another route.</p>
    </div>
    </div>
    </div>
    </div>
<div class="card mt-3">
    <h2>Need More Help?</h2>
    <div class="grid grid-2">
    <div>
    <h3>Helpline</h3>
<p>Call: 0800 METRO BUS (0800 638 762)</p>
    <p>Available 24/7</p>
    </div>
    <div>
    <h3>Customer Service</h3>
    <p>Email: info@metrobus.co.za</p>
    <p>Visit: Any major MetroBus station</p>
    </div>
    </div>
    </div>
    </section>
</main>
<style>
    .accordion {
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .accordion-item {
        border-bottom: 1px solid #ddd;
    }

    .accordion-item:last-child {
        border-bottom: none;
    }

    .accordion-header {
        width: 100%;
        padding: 1rem;
        background: none;
        border: none;
        text-align: left;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 1rem;
        font-weight: bold;
    }

    .accordion-header:hover {
        background-color: #f8f9fa;
    }

    body.dark-mode .accordion-header:hover {
        background-color: #2a2a2a;
    }

    .accordion-content {
        padding: 0 1rem 1rem;
        display: none;
        background-color: #f9f9f9;
    }

    body.dark-mode .accordion-content {
        background-color: #1a1a1a;
    }

    .accordion-content.active {
        display: block;
    }

    .accordion-icon {
        transition: transform 0.3s;
    }

    .accordion-header.active .accordion-icon {
        transform: rotate(45deg);
    }
</style>
<script>
    function toggleAccordion(header) {
        const content = header.nextElementSibling;
        const isActive = content.classList.contains('active');
        document.querySelectorAll('.accordion-content').forEach(item => {
        item.classList.remove('active');
        });
        document.querySelectorAll('.accordion-header').forEach(item => {
        item.classList.remove('active');
        });
    if (!isActive) {
        content.classList.add('active');
        header.classList.add('active');
        }
    }
</script>
<?php require_once 'includes/footer.php'; ?>