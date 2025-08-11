🛡 Cybersecurity Essentials — OWASP TCET

Hands-on lab repository for the Cybersecurity Essentials event, hosted under OWASP TCET on 12 August 2025 at Thakur College of Engineering and Technology.

---

📚 Table of Contents

1. [Event Info](#-event-info)  
2. [Purpose](#-purpose)  
3. [Covered Attacks](#-covered-attacks)  
4. [Requirements](#-requirements)  
5. [Getting Started](#-getting-started)  
6. [Resources](#-resources)  
7. [Disclaimer](#-disclaimer)  

---

📅 Event Info

- Date: 12 August 2025  
- Venue: Thakur College of Engineering and Technology  
- Speakers: Anurag Dharmendra Kumar Maurya & Ahtesham Ali Khan  

---

🎯 Purpose

This repository contains practical hands-on exercises designed to teach participants how common web security vulnerabilities work, how to exploit them in a safe, controlled environment, and most importantly — how to mitigate them.

The focus is on learning-by-doing so attendees gain real-world security testing experience.

---

🧪 Covered Attacks

Each folder in this repository contains a lab for a specific attack.

1. Client-Side Validation Bypass — Bypass browser-based input checks.
2. IDOR (Insecure Direct Object Reference) — Access unauthorized data by manipulating object references.
3. Directory Busting — Discover hidden files and directories on a web server.  
4. Stored XSS (Cross-Site Scripting) — Inject persistent malicious scripts into a site. 
5. Cookie Tampering — Modify cookies to escalate privileges or bypass restrictions.
6. Command Injection — Execute system commands through vulnerable inputs.
7. Mass Assignment — Exploit automatic object mapping to modify protected fields. 

---

🛠 Requirements

- Kali Linux or any Linux-based penetration testing environment  
- Node.js and npm installed  
- Web browser with developer tools enabled  

---

🚀 Getting Started

1. Clone the repository:  
   git clone https://github.com/GodofConquest04/Cybersecurity-Essentials.git;
   
   cd Cybersecurity-Essentials;
   
   
3. Install all necessary modules

   apt install apache2 npm nodejs -y;
   
3. Copy all files to your Apache web root and change permissions(for Debian /var/www/html/):  
   cp -r * /var/www/html/;
   cd /var/www/html/;
   chown -R www-data:www-data /var/www/html/;
   chmod 666 /var/www/html/chat/messages.json;

4. Install required Node.js packages:  
   npm install express path jsonwebtoken cookie-parser;
   npm init -y;

5. Start the Node.js server:
   node ./param/server.js;
---
