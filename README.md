Stellaris AI | Solar Predictive Modelling Dashboard
A high-fidelity, kinetic interface designed for real-time solar array monitoring and predictive energy modelling. This dashboard visualizes complex telemetry data for photovoltaic systems, featuring simulated deep-learning forecasts and inverter diagnostics.
⚡ Core Capabilities
Real-Time Solar Telemetry: Monitors critical metrics including Power Output (KW), Inverter Load, Panel Temperature, and System Integrity with millisecond-latency simulation.
Predictive Horizon Modelling: A dedicated "Horizon Forecast" module that visualizes predicted efficiency and energy generation (kWh) using simulated deep learning epochs.
Kinetic Data Visualization: Features CRT-style scan lines, grid panning, and "flash" updates to represent high-frequency data streams and grid anomalies.
Anomaly Detection: Simulates voltage variations and system alerts (e.g., Storm Front warnings) to demonstrate incident response UIs.
Responsive Industrial Design: Optimized for 1920x1080 control room displays while remaining fully responsive for field tablet usage.
🛠️ Tech Stack
Core: HTML5, CSS3, JavaScript (ES6+)
Styling: Tailwind CSS (via CDN)
Icons: Lucide Icons (via CDN)
Fonts: Inter & System Monospace (for raw data presentation)
🚀 Getting Started
Prerequisites
You only need a modern web browser (Chrome, Firefox, Safari, Edge).
Installation
Clone the repository:
git clone [https://github.com/yourusername/stellaris-dashboard.git](https://github.com/yourusername/stellaris-dashboard.git)


Navigate to the project folder:
cd stellaris-dashboard


Add your assets:
Ensure you have a src folder with your organization's logo:
/src/uitm.png


Run:
Simply open index.html in your browser.
🌐 Deployment
This dashboard is a static web application. It is completely client-side and decoupled from any backend logic, meaning:
No Server Required: It runs entirely in the user's browser.
Hosting: It can be hosted on any static file server including GitHub Pages, Vercel, Netlify, Cloudflare Pages, or a standard Apache/Nginx web server.
CI/CD: Deploys instantly via drag-and-drop or simple git-hooks on modern hosting platforms.
📂 Project Structure
├── index.html        # Main dashboard application
├── src/
│   └── uitm.png      # Local logo asset (required)
└── README.md         # Documentation


🎮 Usage Guide
Flux Diagnostics (Home):
Monitor live power generation (KW).
Check hardware health (Inverters, Panels).
View real-time "Anomaly Logs" for voltage fluctuations.
Predictive Model:
Navigate to the "Predictive Model" tab.
View simulated forecast confidence intervals and training epochs.
Check for environmental warnings (e.g., Weather alerts impacting generation).
Simulation Mode:
Toggle SIMULATION MODE in the sidebar to inject random noise and variability into the data stream, useful for demonstrating the UI's responsiveness to changing solar conditions.
🎨 Customization
To change the primary safety color (currently Safety Yellow), modify the CSS variables in index.html:
:root {
    --color-accent: #facc15; /* Change to your brand color */
}


📄 License
This project is open source and available under the MIT License.
