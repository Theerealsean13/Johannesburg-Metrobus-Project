# MetroBus Johannesburg - Public Transport Platform
[![PHP](https://img.shields.io/badge/PHP-8.0+-blue.svg)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-orange.svg)](https://www.mysql.com/)
[![HTML5](https://img.shields.io/badge/HTML5-E34F26.svg)](https://html.spec.whatwg.org/)
[![CSS3](https://img.shields.io/badge/CSS3-1572B6.svg)](https://www.w3.org/Style/CSS/)
[![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E.svg)](https://www.ecma-international.org/publications-and-standards/standards/ecma-262/)

A modern, responsive, and production-ready web platform for Johannesburg's MetroBus public transport system. Built with clean, vanilla technologies to provide commuters, tourists, and first-time users with comprehensive route information, live tracking, trip planning, fare calculations, and more.

## 🚀 Features

### Core Functionality
- **Route Browser**: Search and filter through all active bus routes with detailed timetables
- **Live Tracking**: Real-time bus status updates with auto-refresh every 15 seconds
- **Trip Planner**: Plan journeys with route suggestions and fare estimates
- **Fare Calculator**: Interactive fare lookup with discount information
- **Service Notices**: Color-coded alerts for disruptions, delays, and important announcements
- **Event Calendar**: Community events and transport-related activities with filtering
- **Passenger Information**: Comprehensive FAQs and guidelines for safe travel
- **User Feedback**: Star-rated feedback system with public reviews

### User Management
- **User Accounts**: Secure registration and login with password hashing
- **Profile Management**: Update personal details and saved preferences
- **Admin Panel**: Complete administrative dashboard for managing routes, analytics, and content

### Smart Features (Optional)
- **AI Delay Prediction**: Flask-based machine learning for predicting bus delays
- **Route Recommendations**: Intelligent suggestions based on user patterns

### Technical Features
- **Responsive Design**: Mobile-first approach with tablet and desktop optimizations
- **Dark Mode**: Automatic and manual theme switching with localStorage persistence
- **Accessibility**: WCAG-compliant with semantic HTML, ARIA labels, and keyboard navigation
- **Security**: Prepared statements, input validation, XSS/CSRF protection
- **Performance**: Optimized assets, lazy loading, and deferred scripts

## 🛠️ Technologies Used

- **Frontend**: HTML5, CSS3 (Vanilla), JavaScript (ES6+)
- **Backend**: PHP 8.0+ with PDO
- **Database**: MySQL 8.0+
- **Environment**: XAMPP (Apache, MySQL, PHP)
- **Optional AI**: Python Flask for smart features
- **No Frameworks**: Pure vanilla implementation (no React, Vue, Angular, or Bootstrap)

## 📋 Prerequisites

- **XAMPP**: Version 8.0+ (includes Apache, MySQL, PHP)
- **Web Browser**: Modern browser with JavaScript enabled
- **Optional**: Python 3.8+ with Flask (for AI features)

## 🚀 Installation & Setup

### 1. Clone the Repository
```bash
git clone https://github.com/yourusername/metrobus-johannesburg.git
cd metrobus-johannesburg
```

### 2. Setup XAMPP Environment
1. Install and start XAMPP
2. Copy the project folder to `C:\xampp\htdocs\metrobus`
3. Start Apache and MySQL services in XAMPP Control Panel

### 3. Database Setup
1. Open phpMyAdmin (http://localhost/phpmyadmin)
2. Create a new database named `metrobus`
3. Import the database schema:
   - Go to the `database` folder
   - Import `metrobus.sql` into the `metrobus` database

### 4. Configuration
1. Update database credentials in `includes/db.php` if needed:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'metrobus');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   ```

### 5. Optional: Setup Smart Features
1. Install Python dependencies:
   ```bash
   pip install flask
   ```
2. Run the Flask app:
   ```bash
   python smart_features.py
   ```
   The AI features will be available at `http://localhost:5000`

### 6. Access the Application
Open your browser and navigate to: `http://localhost/metrobus`

## 📖 Usage

### For Passengers
1. **Browse Routes**: Use the Routes page to search and filter bus routes
2. **Plan Trips**: Enter start and destination on the Trip Planner
3. **Check Live Status**: Monitor real-time bus positions on Live Tracking
4. **Calculate Fares**: Use the fare calculator for cost estimates
5. **Stay Informed**: Check notices for service updates and events
6. **Provide Feedback**: Share your experience through the feedback form

### For Administrators
1. Login with admin credentials (default: admin@metrobus.co.za / admin123)
2. Access the admin panel at `/admin/dashboard.php`
3. Manage routes, view analytics, and monitor feedback

### Dark Mode
- Toggle dark mode using the moon/sun icon in the navigation
- Preference is automatically saved in your browser

## 📸 Screenshots

### Home Dashboard
![Home Dashboard](screenshots/home-dashboard.png)
*Main dashboard with quick access cards and live alerts*

### Route Browser
![Route Browser](screenshots/route-browser.png)
*Search and filter through available bus routes*

### Live Tracking
![Live Tracking](screenshots/live-tracking.png)
*Real-time bus status with color-coded indicators*

### Trip Planner
![Trip Planner](screenshots/trip-planner.png)
*Interactive journey planning with fare estimates*

### Mobile Responsive
![Mobile View](screenshots/mobile-responsive.png)
*Fully responsive design optimized for mobile devices*

*Note: Screenshots are placeholders. Replace with actual images when available.*

## 🏗️ Project Structure

```
metrobus/
├── assets/
│   ├── css/
│   │   ├── style.css          # Main stylesheet
│   │   └── responsive.css     # Responsive breakpoints
│   ├── js/
│   │   └── app.js             # Client-side JavaScript
│   └── icons/
│       └── favicon.svg        # Site favicon
├── includes/
│   ├── db.php                 # Database configuration
│   ├── auth.php               # Authentication functions
│   ├── header.php             # Common header/navigation
│   └── footer.php             # Site footer
├── api/
│   ├── get_routes.php         # Route data API
│   ├── get_live_status.php    # Live tracking API
│   ├── submit_feedback.php    # Feedback submission API
│   ├── trip_search.php        # Trip planning API
│   ├── get_fare.php           # Fare calculation API
│   ├── get_recent_feedback.php # Recent feedback API
│   └── get_recent_activity.php # Activity data API
├── admin/
│   ├── dashboard.php          # Admin overview
│   ├── manage_routes.php      # Route management
│   └── analytics.php          # Usage analytics
├── database/
│   └── metrobus.sql           # Database schema
├── smart_features.py          # Optional Flask AI features
├── index.php                  # Home page
├── routes.php                 # Route browser
├── live_tracking.php          # Live tracking
├── trip_planner.php           # Trip planner
├── fares.php                  # Fare information
├── passenger_info.php         # Passenger guidelines
├── notices.php                # Service notices
├── events.php                 # Event calendar
├── feedback.php               # User feedback
├── login.php                  # User login
├── register.php               # User registration
├── profile.php                # User profile
├── logout.php                 # Logout handler
├── README.md                  # This file
├── PRESENTATION.md            # Presentation materials
├── GEMINI_POWERPOINT_PROMPT.txt # PowerPoint generation prompt
├── QUICK_REFERENCE.txt        # Quick facts guide
├── PRESENTATION_SLIDESHOW.html # Interactive slideshow
└── HOW_TO_USE_PRESENTATIONS.txt # Presentation guide
```

## 📄 License

This project is licensed under the Greenview College License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- Johannesburg MetroBus for providing transport data and inspiration
- Open source community for the tools and libraries used
- Contributors and users for their feedback and support

## 📞 Support

For support or questions:
- Email: Shawnshabangu18@gmail.com.co.za
- GitHub Issues: [Create an issue](https://github.com/yourusername/metrobus-johannesburg/issues)

---

**Built with ❤️ for Johannesburg commuters**