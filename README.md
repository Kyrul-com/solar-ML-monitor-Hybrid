````md
# **Stellaris AI | Solar Predictive Modelling Dashboard**

A high-fidelity, kinetic interface designed for real-time solar array monitoring and predictive energy modelling. This dashboard visualizes complex telemetry data for photovoltaic systems, featuring simulated deep-learning forecasts and inverter diagnostics.

---

## ⚡ **Core Capabilities**

### **Real-Time Solar Telemetry**
Monitors critical metrics including:
- Power Output (KW)
- Inverter Load
- Panel Temperature
- System Integrity  
with millisecond-latency simulation.

### **Predictive Horizon Modelling**
A dedicated **Horizon Forecast** module visualizing:
- Predicted efficiency
- Energy generation (kWh)
- Simulated deep-learning epochs

### **Kinetic Data Visualization**
Includes:
- CRT-style scan lines  
- Grid panning  
- “Flash” updates  
to represent high-frequency data streams and grid anomalies.

### **Anomaly Detection**
Simulates:
- Voltage variations
- System alerts (e.g., *Storm Front* warnings)  
for incident response UI demonstrations.

### **Responsive Industrial Design**
Optimized for:
- 1920×1080 control room displays  
- Fully responsive mobile/tablet field usage  

---

## 🛠️ **Tech Stack**

- **Core:** HTML5, CSS3, JavaScript (ES6+)
- **Styling:** Tailwind CSS (via CDN)
- **Icons:** Lucide Icons (via CDN)
- **Fonts:** Inter & system monospace (for raw data)

---

## 🚀 **Getting Started**

### **Prerequisites**
A modern web browser (Chrome, Firefox, Safari, Edge).

### **Installation**

Clone the repository:

```sh
git clone https://github.com/yourusername/stellaris-dashboard.git
````

Navigate to the folder:

```sh
cd stellaris-dashboard
```

Add your assets (required):

```
/src/uitm.png
```

Run the dashboard:

* Open `index.html` in your browser.

---

## 🌐 **Deployment**

This application is **100% static** and runs purely client-side.

### No Server Required

All logic executes in-browser.

### Hosting Options

* GitHub Pages
* Vercel
* Netlify
* Cloudflare Pages
* Any Apache/Nginx static host

### CI/CD

Deploy via:

* Git hooks
* Drag-and-drop
* Auto-build pipelines

---

## 📂 **Project Structure**

```
├── index.html        # Main dashboard application
├── src/
│   └── uitm.png      # Logo asset (required)
└── README.md         # Documentation
```

---

## 🎮 **Usage Guide**

### **Flux Diagnostics (Home)**

* Monitor live power generation (KW)
* Check hardware health (Inverters, Panels)
* View real-time voltage fluctuation logs

### **Predictive Model**

* Open the *Predictive Model* tab
* View confidence intervals & training epochs
* See environmental warnings (weather, storms, shading)

### **Simulation Mode**

Enable **SIMULATION MODE** to:

* Inject random telemetry noise
* Stress-test the UI
* Visualize system adaptation to rapid environmental changes

---

## 🎨 **Customization**

Modify accent color in `index.html`:

```css
:root {
    --color-accent: #facc15; /* Replace with your brand color */
}
```

---

## 📄 **License**

Released under the **MIT License** — free for commercial and open-source use.

---

```

