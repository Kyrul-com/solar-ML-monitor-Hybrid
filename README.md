# Stellaris AI | Solar Predictive Modelling Dashboard

A high-fidelity, kinetic interface designed for real-time solar array monitoring and predictive energy modelling. This dashboard visualizes complex telemetry data for photovoltaic systems, featuring simulated deep-learning forecasts and inverter diagnostics.

---

## ⚡ Core Capabilities

### Real-Time Solar Telemetry
Monitors critical metrics including:
- Power Output (KW)
- Inverter Load
- Panel Temperature
- System Integrity  
With millisecond-latency simulation.

### Predictive Horizon Modelling
A dedicated Horizon Forecast module that visualizes:
- Predicted efficiency
- Energy generation (kWh)
- Simulated deep-learning epochs

### Kinetic Data Visualization
Includes:
- CRT-style scan lines  
- Grid panning  
- Flash updates  
To represent high-frequency data streams and grid anomalies.

### Anomaly Detection
Simulates:
- Voltage variations
- System alerts (e.g., Storm Front warnings)
Useful for demonstrating incident response UIs.

### Responsive Industrial Design
Optimized for:
- 1920×1080 control room displays  
- Field tablets and mobile use

---

## 🛠️ Tech Stack

- **Core:** HTML5, CSS3, JavaScript (ES6+)
- **Styling:** Tailwind CSS (via CDN)
- **Icons:** Lucide Icons (via CDN)
- **Fonts:** Inter & System Monospace

---

## 🚀 Getting Started

### Prerequisites
A modern web browser (Chrome, Firefox, Safari, Edge).

### Installation

Clone the repository:

git clone https://github.com/yourusername/stellaris-dashboard.git

Navigate to the project folder:

cd stellaris-dashboard

Add your assets:

/src/uitm.png

Run:

- Open `index.html` in your browser.

---

## 🌐 Deployment

This dashboard is fully client-side.

### No Server Required
Runs entirely in the browser.

### Hosting Options
- GitHub Pages  
- Vercel  
- Netlify  
- Cloudflare Pages  
- Any static Apache/Nginx host  

### CI/CD
Deploys instantly via:
- Git hooks  
- Drag-and-drop  
- Automated builds  

---

## 📂 Project Structure

├── index.html        # Main dashboard application  
├── src/  
│   └── uitm.png      # Local logo asset (required)  
└── README.md         # Documentation  

---

## 🎮 Usage Guide

### Flux Diagnostics (Home)
- Monitor live power generation (KW)
- Check inverter + panel health
- View real-time anomaly logs for voltage fluctuations

### Predictive Model
- Navigate to the Predictive Model tab  
- View forecast confidence intervals  
- Monitor simulated training epochs  
- Detect environmental warnings

### Simulation Mode
Toggle SIMULATION MODE to:
- Inject random noise into telemetry  
- Stress-test UI responsiveness  
- Visualize rapid solar condition changes  

---

## 🎨 Customization

Change the primary safety color in `index.html`:

:root {
    --color-accent: #facc15; /* Change to your brand color */
}

---

## 📄 License

This project is open source and available under the MIT License.
