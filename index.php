<?php
// index.php — Showcase UI only (no backend logic)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Solar Power Prediction Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        /* --- CORE VARIABLES (BLUE THEME) --- */
        :root {
            --color-bg-primary: #0D1117; 
            --color-sidebar-bg: #161B22; 
            --color-text-main: #EFEFF4; 
            --color-text-secondary: #A0A0B0;
            --color-accent: #3b82f6; 
            --color-accent-dark: #2563eb;
            --color-border: #30363D;
            --color-card-bg-light: #1E232B;
            --color-card-bg: #161B22;
            --color-chart-prediction: #10B981; 
            --color-chart-history: #FBBF24; 
            /* Colors for Model Visualization */
            --color-gru: #EF4444; /* Reddish for GRU */
            --color-lstm: #34D399; /* Greenish for LSTM */
            --color-input: #A0A0B0; /* Input Layer */
            --color-output: var(--color-accent); /* Output Layer */
            --color-delete: #F44336; /* Delete Button Color */
        }

        /* --- GLOBAL LAYOUT & TYPOGRAPHY --- */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--color-bg-primary);
            color: var(--color-text-main);
            margin: 0;
            display: flex; 
            height: 100vh;
            overflow: hidden;
        }

        h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-accent);
            letter-spacing: 0.5px;
            margin-bottom: 0;
        }

        h2 {
            font-weight: 600;
            color: var(--color-text-main);
            margin-top: 0;
            margin-bottom: 2rem;
            font-size: 1.6rem;
            border-bottom: 1px solid var(--color-border);
            padding-bottom: 0.5rem;
            text-align: left;
        }

        .hidden { display: none; }
        
        /* --- SIDEBAR NAVIGATION --- */
        .sidebar {
            width: 250px;
            background-color: var(--color-sidebar-bg);
            padding: 2rem 1rem;
            display: flex;
            flex-direction: column;
            border-right: 1px solid var(--color-border);
        }

        .tab-buttons {
            display: flex;
            flex-direction: column;
            margin-top: 2.5rem;
            flex-grow: 1;
        }

        .tab-buttons button {
            all: unset;
            color: var(--color-text-secondary);
            padding: 0.75rem 1rem;
            margin: 0.25rem 0;
            border-radius: 0.5rem;
            text-align: left;
            font-size: 1rem;
            font-weight: 400;
            transition: background-color 0.2s, color 0.2s;
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        .tab-buttons button:hover {
            background-color: var(--color-card-bg-light);
            color: var(--color-text-main);
        }

        .tab-buttons button.active {
            background-color: var(--color-accent);
            color: var(--color-bg-primary);
            font-weight: 600;
        }
        .tab-buttons button span {
            margin-right: 10px;
            font-weight: 700;
        }

        /* --- MAIN CONTENT AREA --- */
        .content-area {
            flex-grow: 1;
            padding: 3rem 4rem;
            overflow-y: auto; 
        }

        .card { 
            background-color: var(--color-card-bg);
            padding: 2.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            margin-bottom: 2rem;
            border: 1px solid var(--color-border);
            text-align: left;
        }

        /* --- Global Action Button --- */
        .action-button {
            all: unset;
            background-color: var(--color-accent); 
            color: var(--color-bg-primary); 
            padding: 0.75rem 2rem;
            margin-top: 2rem;
            border-radius: 0.5rem; 
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 10px rgba(59, 130, 246, 0.4);
            transition: all 0.2s;
            float: right;
            cursor: pointer;
            display: inline-block;
        }
        .action-button:hover {
            background-color: var(--color-accent-dark); 
            box-shadow: 0 6px 15px rgba(59, 130, 246, 0.6);
        }
        
        /* --- Tab 1: Upload Dropzone --- */
        .dropzone-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 1.5rem;
            border: 2px dashed var(--color-accent); 
            background-color: var(--color-card-bg-light);
            border-radius: 0.75rem;
            margin: 1.5rem 0;
            box-shadow: inset 0 0 10px rgba(59, 130, 246, 0.15);
        }
        .dropzone-container p {
            color: var(--color-text-secondary);
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }
        .file-upload-button {
            background-color: var(--color-accent);
            color: var(--color-bg-primary);
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .file-upload-button:hover {
            background-color: var(--color-accent-dark);
        }
        #fileInput {
            display: none;
        }
        
        /* --- Tab 2: Model Stack Customization --- */
        .model-config-container {
            display: grid;
            grid-template-columns: 2fr 3fr; 
            gap: 2rem;
            margin-top: 1rem;
        }

        .control-buttons-group {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .layer-action-button {
            all: unset;
            padding: 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 1.1rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        .layer-action-button.gru-type {
            background-color: var(--color-gru);
            color: var(--color-bg-primary);
        }
        .layer-action-button.lstm-type {
            background-color: var(--color-lstm);
            color: var(--color-bg-primary);
        }
        .layer-action-button.delete-type {
            background-color: var(--color-delete);
            color: var(--color-text-main);
            margin-top: 1rem;
        }
        .layer-action-button:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        /* Model Visualization (Sandwich) */
        .model-visualization {
            background-color: var(--color-card-bg-light);
            padding: 1.5rem;
            border-radius: 0.5rem;
            height: 100%;
            min-height: 250px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--color-border);
        }
        #modelStack {
            display: flex;
            flex-direction: column-reverse; 
            align-items: center;
            gap: 5px;
            padding: 10px 0;
            width: 80%;
        }
        .layer {
            width: 100%;
            padding: 0.75rem 0;
            border-radius: 0.3rem;
            text-align: center;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--color-bg-primary);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease-in-out;
        }
        .layer.input-layer { background-color: var(--color-input); color: var(--color-bg-primary); }
        .layer.output-layer { background-color: var(--color-output); color: var(--color-bg-primary); }
        .layer.gru-layer { background-color: var(--color-gru); }
        .layer.lstm-layer { background-color: var(--color-lstm); }

        #modelChoice {
            font-size: 0.9rem;
            font-weight: 400;
            color: var(--color-text-secondary);
            margin-top: 1.5rem;
            text-align: center;
        }
        
        /* --- Tab 3 & 4 Tables --- */
        table {
            width: 100%; border-collapse: separate; border-spacing: 0;
            margin-top: 1rem; border-radius: 0.5rem; overflow: hidden; 
        }
        th, td { padding: 1rem; text-align: left; font-size: 0.95rem; border: none; }
        th {
            background-color: var(--color-card-bg-light); color: var(--color-text-main);
            font-weight: 600; border-bottom: 1px solid var(--color-border);
        }
        td {
            background-color: var(--color-card-bg); border-bottom: 1px solid var(--color-border);
            color: var(--color-text-secondary);
        }
        td:first-child { color: var(--color-text-main); }
        tr:last-child td { border-bottom: none; }

        /* --- Tab 4 Dashboard Specifics (Chart Styling) --- */
        .kpi-group { display: flex; justify-content: space-between; gap: 2rem; margin-bottom: 2rem; }
        .kpi-card {
            flex: 1; background-color: var(--color-card-bg-light); padding: 1.5rem;
            border-radius: 0.75rem; border-left: 5px solid var(--color-accent);
        }
        .kpi-card p { margin: 0; font-size: 0.9rem; color: var(--color-text-secondary); }
        .kpi-card strong {
            display: block; font-size: 2rem; font-weight: 700; color: var(--color-accent); margin-top: 0.5rem;
        }
        .kpi-card.secondary { border-left-color: var(--color-chart-prediction); }
        .kpi-card.secondary strong { color: var(--color-chart-prediction); }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-top: 2rem;
        }
        .dashboard-grid .card { padding: 1.5rem; margin-bottom: 0; }
        .dashboard-grid .card h3 {
            font-size: 1.1rem; font-weight: 600; margin-top: 0; margin-bottom: 1rem;
            color: var(--color-text-main);
        }
        /* Ensures canvases fill space correctly */
        .dashboard-grid canvas {
            width: 100% !important; 
            height: 250px !important; /* Fixed height for clean grid layout */
            max-height: 250px; 
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h1>GRU–LSTM Hybrid</h1>
        <div class="tab-buttons">
            <button class="tab-btn active" data-tab-index="0" onclick="showTab(0)"><span>1</span> Upload Source Data</button>
            <button class="tab-btn" data-tab-index="1" onclick="showTab(1)"><span>2</span> Customize Model Stack</button>
            <button class="tab-btn" data-tab-index="2" onclick="showTab(2)"><span>3</span> Data Transformation</button>
            <button class="tab-btn" data-tab-index="3" onclick="showTab(3)"><span>4</span> View Dashboard</button>
        </div>
    </div>

    <div class="content-area">

        <div class="tab" id="tab0">
            <h2>Source Data Upload</h2>
            <div class="card">
                <p style="color:var(--color-text-secondary);">
                    Please upload a clean CSV file containing time-series data for training and prediction.
                </p>
                
                <div class="dropzone-container" onclick="document.getElementById('fileInput').click();">
                    <p>Drag & Drop CSV file here, or click the button below to browse.</p>
                    <div class="file-upload-button">Select File</div>
                    <input type="file" id="fileInput" accept=".csv" />
                </div>

                <button class="action-button" onclick="showTab(1)">Next Step: Customize Model Stack</button>
                <div style="clear:both;"></div>
            </div>
        </div>

        <div class="tab hidden" id="tab1">
            <h2>Customize Recurrent Stack</h2>
            <div class="card">
                <p style="color:var(--color-text-secondary); margin-bottom: 1.5rem;">
                    Build your stacked RNN architecture by adding **GRU** (Red) and **LSTM** (Green) layers. Layers are stacked on top of the input.
                </p>
                
                <div class="model-config-container">
                    
                    <div class="control-buttons-group">
                        <button class="layer-action-button gru-type" onclick="addLayer('GRU')">
                            + Add GRU Layer
                        </button>
                        <button class="layer-action-button lstm-type" onclick="addLayer('LSTM')">
                            + Add LSTM Layer
                        </button>
                        
                        <button class="layer-action-button delete-type" id="deleteLayerButton" onclick="deleteLayer()">
                            Delete Last Layer
                        </button>
                    </div>
                    
                    <div class="model-visualization">
                        <div id="modelStack">
                            </div>
                    </div>
                </div>
                
                <p id="modelChoice">Model Stack: 0 Recurrent Layers</p>

                <button class="action-button" id="nextStepTab2" onclick="showTab(2)">Next Step: Preprocessing</button>
                <div style="clear:both;"></div>
            </div>
        </div>

        <div class="tab hidden" id="tab2">
            <h2>Data Imputation Preview</h2>
            <div class="card">
                <p style="color:var(--color-text-secondary); margin-bottom: 1.5rem;">
                    The system detected missing values (NaN) and imputed them using a **dynamic mean strategy** derived from neighboring data points. Review a sample of the imputation process below.
                </p>
                <table>
                    <thead>
                        <tr><th>Time Step (Index)</th><th>Original Temp (°C)</th><th>Imputed/Fixed Temp (°C)</th><th>Imputed Value Flag</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>2024-10-01 10:00:00</td><td>**NaN** (Missing)</td><td>**23.4**</td><td><span style="color:var(--color-chart-prediction);">✓ FIXED</span></td></tr>
                        <tr><td>2024-10-01 10:05:00</td><td>25.1</td><td>25.1</td><td>-</td></tr>
                        <tr><td>2024-10-01 10:10:00</td><td>**-** (Empty String)</td><td>**24.8**</td><td><span style="color:var(--color-chart-prediction);">✓ FIXED</span></td></tr>
                        <tr><td>2024-10-01 10:15:00</td><td>24.5</td><td>24.5</td><td>-</td></td>
                        <tr><td>2024-10-01 10:20:00</td><td>24.9</td><td>24.9</td><td>-</td></tr>
                    </tbody>
                </table>
                <button class="action-button" onclick="showTab(3)">Launch Dashboard</button>
                <div style="clear:both;"></div>
            </div>
        </div>

        <div class="tab hidden" id="tab3">
            <h2>Solar Power Prediction Dashboard</h2>
            
            <div class="kpi-group">
                <div class="kpi-card" style="border-left-color: var(--color-chart-history);">
                    <p>Current Power Output (kW)</p>
                    <strong style="color: var(--color-chart-history);" id="kpiCurrentOutput">82.4</strong>
                </div>
                <div class="kpi-card secondary">
                    <p>Predicted 24h Peak (kW)</p>
                    <strong id="kpiPredictedPeak">91.2</strong>
                </div>
                <div class="kpi-card" style="border-left-color: var(--color-accent);">
                    <p>Model Confidence (F1-Score)</p>
                    <strong style="color: var(--color-accent);">0.95</strong>
                </div>
            </div>

            <div class="card">
                <h3>Historical Performance (Last 3 Months)</h3>
                <p style="color:var(--color-text-secondary); margin-bottom: 1.5rem; font-size:0.9rem;">
                    Weekly aggregation of the **Mean Absolute Error (MAE)** and **Actual Generation** figures.
                </p>
                <table id="historicalTable">
                    <thead>
                        <tr><th>Week</th><th>Avg. Power (kWh)</th><th>Max. Peak (kW)</th><th>Model MAE</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>Current Week</td><td>4500</td><td>89.1</td><td>2.1%</td></tr>
                        <tr><td>Week -1</td><td>4620</td><td>90.5</td><td>1.9%</td></tr>
                        <tr><td>Week -2</td><td>4350</td><td>87.0</td><td>2.3%</td></tr>
                        <tr><td>Week -3</td><td>4710</td><td>92.2</td><td>1.8%</td></tr>
                        <tr><td>Week -4</td><td>4480</td><td>88.5</td><td>2.0%</td></tr>
                        <tr><td>Week -5</td><td>4550</td><td>89.9</td><td>1.9%</td></tr>
                        <tr><td>Week -6</td><td>4390</td><td>87.5</td><td>2.2%</td></tr>
                        <tr><td>Week -7</td><td>4650</td><td>91.0</td><td>1.7%</td></tr>
                        <tr><td>Week -8</td><td>4280</td><td>86.5</td><td>2.4%</td></tr>
                        <tr><td>Week -9</td><td>4580</td><td>90.0</td><td>1.8%</td></tr>
                        <tr><td>Week -10</td><td>4450</td><td>88.0</td><td>2.1%</td></tr>
                        <tr><td>Week -11</td><td>4200</td><td>85.9</td><td>2.3%</td></tr>
                        <tr><td>Week -12</td><td>4100</td><td>85.5</td><td>2.5%</td></tr>
                    </tbody>
                </table>
            </div>
            
            <div class="dashboard-grid">
                <div class="card">
                    <h3>Last 60 Minutes Output (kW) - Real-Time Feed</h3>
                    <canvas id="chartRealTime" width="400" height="250"></canvas>
                </div>
                <div class="card">
                    <h3>Prediction Forecast (Next 12 Weeks)</h3>
                    <canvas id="chartPrediction" width="400" height="250"></canvas>
                </div>
            </div>
            
            <button class="action-button" onclick="showTab(0)" style="float:left;">Start New Analysis</button>
            <div style="clear:both;"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const tabs = document.querySelectorAll('.tab');
        const buttons = document.querySelectorAll('.tab-btn');
        const CHART_PREDICTION_COLOR = '#10B981';
        const CHART_HISTORY_COLOR = '#FBBF24';
        
        // Global chart and layer state variables
        window.realTimeChart = null;
        window.predictionChart = null;
        window.realTimeInterval = null; // Re-enabling the interval
        
        // Model Stack: An array to hold the sequence of layers (e.g., ['GRU', 'LSTM', 'GRU'])
        let modelLayers = ['GRU', 'LSTM']; // Initial stack

        // --- Core UI Functions ---
        function showTab(index) {
            
            // Clear interval if user navigates away from the dashboard
            if (index !== 3 && window.realTimeInterval) {
                clearInterval(window.realTimeInterval);
                window.realTimeInterval = null;
                // If the user navigates away, destroy the charts to force a fresh render on return
                if (window.realTimeChart) { window.realTimeChart.destroy(); window.realTimeChart = null; }
                if (window.predictionChart) { window.predictionChart.destroy(); window.predictionChart = null; }
            }
            
            tabs.forEach(t => t.classList.add('hidden'));
            tabs[index].classList.remove('hidden');
            
            buttons.forEach(b => b.classList.remove('active'));
            const newActiveButton = document.querySelector(`.tab-btn[data-tab-index="${index}"]`);
            if (newActiveButton) {
                 newActiveButton.classList.add('active');
            }
            
            // FIX: Initialize charts ONLY when the dashboard tab is visible (index 3)
            if (index === 3) {
                 if (!window.realTimeChart) renderRealTimeChart();
                 if (!window.predictionChart) renderPredictionChart();
            } else if (index === 1) {
                 // Update the visualization and controls on Tab 2 load
                 renderModelStack();
                 updateControls();
            }
            
            document.querySelector('.content-area').scrollTop = 0;
        }
        showTab(0); 

        // --- Layer Customization Functions (Tab 2) ---

        function renderModelStack() {
            const stackElement = document.getElementById('modelStack');
            stackElement.innerHTML = '';
            
            const totalRecurrentLayers = modelLayers.length;
            
            // 1. Output Layer (always on top)
            const output = document.createElement('div');
            output.className = 'layer output-layer';
            output.textContent = 'Output Layer (Prediction)';
            stackElement.appendChild(output);
            
            // 2. Recurrent Layers (LSTM and GRU) - Rendered from the end of the array (top of stack)
            modelLayers.slice().reverse().forEach((type, index) => {
                const layer = document.createElement('div');
                layer.className = `layer ${type.toLowerCase()}-layer`;
                layer.textContent = `${type} Layer (Stack Position ${totalRecurrentLayers - index})`;
                stackElement.appendChild(layer);
            });
            
            // 3. Input Layer (always on the bottom)
            const input = document.createElement('div');
            input.className = 'layer input-layer';
            input.textContent = 'Input Layer (Time-Series Data)';
            stackElement.appendChild(input);

            updateControls();
            updateModelSummary();
        }

        function updateModelSummary() {
             const gruCount = modelLayers.filter(l => l === 'GRU').length;
             const lstmCount = modelLayers.filter(l => l === 'LSTM').length;
             const totalLayers = modelLayers.length;

             document.getElementById('modelChoice').innerText = 
                 `Model Stack: ${gruCount} GRU Layer(s) + ${lstmCount} LSTM Layer(s). Total Recurrent Layers: ${totalLayers}`;
        }
        
        function updateControls() {
             const totalLayers = modelLayers.length;
             
             // Delete button is enabled only if there's at least one recurrent layer
             document.getElementById('deleteLayerButton').disabled = totalLayers === 0;
             
             // Next button is enabled only if there's at least one recurrent layer
             const nextButton = document.getElementById('nextStepTab2');
             if (totalLayers === 0) {
                 nextButton.setAttribute('disabled', true);
                 nextButton.style.opacity = 0.5;
             } else {
                 nextButton.removeAttribute('disabled');
                 nextButton.style.opacity = 1;
             }
        }

        function addLayer(type) {
             modelLayers.push(type);
             renderModelStack();
        }

        function deleteLayer() {
             if (modelLayers.length > 0) {
                 modelLayers.pop(); 
                 renderModelStack();
             }
        }
        
        // --- Chart/Data Functions (Tab 4) ---

        // Helper to get time label (e.g., 14:35:05)
        function getTimeLabel() {
            const now = new Date();
            return now.getHours().toString().padStart(2, '0') + ':' + 
                   now.getMinutes().toString().padStart(2, '0') + ':' + 
                   now.getSeconds().toString().padStart(2, '0');
        }

        // Initial Data for the Real-Time Chart (60 data points for 60 minutes)
        let chartData = {
            // Labels are placeholder '60m ago' down to '1m ago'
            labels: Array(60).fill(0).map((_, i) => `${60 - i}m ago`),
            datasets: [{
                label: 'Power Output (kW)',
                data: Array(60).fill(81).map(v => (v + Math.random() * 8 - 4).toFixed(1)),
                borderColor: CHART_HISTORY_COLOR,
                backgroundColor: null, /* Will be set as gradient */
                borderWidth: 3,
                pointRadius: 0,
                tension: 0.4, 
                fill: true
            }]
        };

        // Function to move the chart data every interval
        function addRealTimeData(chart) {
            
            // 1. Generate new data point (random fluctuation around 85kW)
            const newOutput = (Math.random() * (90 - 80) + 80).toFixed(1);

            // 2. Update KPI display
            document.getElementById('kpiCurrentOutput').innerText = newOutput;

            // 3. Shift the data (removes oldest point, adds newest)
            chart.data.labels.shift();
            chart.data.datasets[0].data.shift();

            // 4. Add the current time and new value
            chart.data.labels.push(getTimeLabel());
            chart.data.datasets[0].data.push(newOutput);

            // 5. Update the chart smoothly
            chart.update('quiet'); // 'quiet' prevents animation for smoother scrolling
        }

        // 1. Real-Time Chart (Dynamic)
        function renderRealTimeChart() {
            const ctx = document.getElementById('chartRealTime').getContext('2d');
            
            // Create a gradient for the fill area - MUST be created after getting context
            const gradient = ctx.createLinearGradient(0, 0, 0, 250);
            gradient.addColorStop(0, 'rgba(251, 191, 36, 0.5)'); // CHART_HISTORY_COLOR with opacity
            gradient.addColorStop(1, 'rgba(251, 191, 36, 0)');
            chartData.datasets[0].backgroundColor = gradient;
            
            window.realTimeChart = new Chart(ctx, {
                type: 'line',
                data: chartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 2500 // Animation duration matches interval for smooth transition
                    },
                    scales: {
                        x: {
                            ticks: { color: 'var(--color-text-secondary)', maxRotation: 0, autoSkip: true, maxTicksLimit: 8 },
                            grid: { color: 'rgba(48, 54, 61, 0.4)' }
                        },
                        y: {
                            ticks: { color: 'var(--color-text-secondary)' },
                            grid: { color: 'rgba(48, 54, 61, 0.4)' },
                            min: 70,
                            max: 100
                        }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
            
            // START THE MOVING INTERVAL
            window.realTimeInterval = setInterval(() => addRealTimeData(window.realTimeChart), 2500);
        }

        // 2. 3-Month Prediction Graph (Static)
        function renderPredictionChart() {
            const ctx = document.getElementById('chartPrediction').getContext('2d');
            
            const predictionLabels = ['Wk 1','Wk 2','Wk 3','Wk 4','Wk 5','Wk 6','Wk 7','Wk 8','Wk 9','Wk 10','Wk 11','Wk 12'];
            const predictionData = [88, 91, 93, 89, 92, 94, 95, 90, 89, 91, 94, 96];

            window.predictionChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: predictionLabels,
                    datasets: [{
                        label: 'Predicted Avg. Peak Power (kW)',
                        data: predictionData,
                        backgroundColor: CHART_PREDICTION_COLOR,
                        borderColor: CHART_PREDICTION_COLOR,
                        borderWidth: 1,
                        borderRadius: 5,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            ticks: { color: 'var(--color-text-secondary)' },
                            grid: { display: false }
                        },
                        y: {
                            ticks: { color: 'var(--color-text-secondary)' },
                            grid: { color: 'rgba(48, 54, 61, 0.4)' },
                            min: 80,
                            max: 100
                        }
                    },
                    plugins: {
                        legend: { display: true, labels: { color: 'var(--color-text-main)' } }
                    }
                }
            });
        }
    </script>

</body>
</html>
