# 🏠 Home Assistant E-Ink Dashboard
A lightweight, web-based dashboard for Home Assistant, specifically designed for legacy devices (such as the Amazon Kindle).

This project utilizes simple HTML, CSS, and JavaScript to ensure maximum compatibility with older browser engines that do not support modern JavaScript (ES6+). It is intended to be served directly via an Apache Webserver (e.g., as a Home Assistant Add-on).

## ✨ Features
- Legacy Browser Support: Uses Vanilla JavaScript (ES5 compatible), optimized for devices with limited performance or outdated WebViews.
- E-Ink Optimized: High contrast, clear layout, and no unnecessary animations.
- Lightweight: No heavy frameworks (no React, Vue, Angular).
- Home Assistant Integration: Uses the Home Assistant REST API to display states and control devices.

## 📋 Prerequisites
- A running Home Assistant instance.
- A web server. The Apache Webserver Add-on in Home Assistant is recommended, but any standard server (nginx, Apache, lighthttpd) will work.
- A Long-Lived Access Token from Home Assistant.
