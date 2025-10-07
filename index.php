<?php
// index.php — Showcase UI only (no backend logic)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hybrid GRU–LSTM Showcase</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* CSS Reset and Core Styles */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f6; /* Lighter background for a cleaner look */
            color: #1c1f23; /* Darker text for contrast */
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Card/Container Style (The Main App Area) */
        .card {
            background-color: #ffffff; /* White card background */
            padding: 2.5rem; /* Increased padding */
            border-radius: 0.75rem; /* Slightly softer corners */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); /* Lighter, more subtle shadow */
            width: 500px; /* Slightly wider card */
            max-width: 90%;
            text-align: center;
            transition: all 0.4s ease;
            border: 1px solid #e0e0e0; /* Subtle border for definition */
        }

        h2 {
            font-weight: 700;
            color: #1c1f23;
            margin-top: 0;
            margin-bottom: 1.5rem;
        }

        /* Button and Input Styling (Primary/Accent Color: A Streamlit-like Blue/Green) */
        button,
        input[type="file"] {
            background-color: #2b8cff; /* Streamlit-like primary blue */
            border: none;
            color: white;
            padding: 0.75rem 1.75rem;
            margin-top: 1rem;
            border-radius: 0.375rem; /* Streamlit-like button curvature */
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: background-color 0.2s, box-shadow 0.2s;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        button:hover {
            background-color: #1e70e0; /* Darker on hover */
            box-shadow: 0 2px 6px rgba(43, 140, 255, 0.4);
        }

        /* File Input Styling */
        input[type="file"] {
            display: block;
            margin: 1.5rem auto 0.5rem;
            padding: 1rem;
            background-color: #f7f9fb; /* Light background for the file drop area */
            border: 2px dashed #a0a0a0;
            color: #1c1f23;
            width: 80%;
            cursor: pointer;
            text-align: left;
            font-size: 0.95rem;
            /* Hide the default button appearance */
            background-color: #fff;
            padding: 1rem;
            border-radius: 0.5rem;
            border: 2px dashed #cfd3da;
            color: #666;
            text-align: center;
            line-height: 1.5;
        }
        /* Custom label for a better file upload aesthetic */
        input[type="file"]::-webkit-file-upload-button {
            visibility: hidden;
            width: 0;
        }
        input[type="file"]::before {
            content: 'Select or Drag & Drop CSV file';
            display: inline-block;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
            padding: 0.5rem 1rem;
            outline: none;
            white-space: nowrap;
            cursor: pointer;
            font-weight: 600;
            color: #2b8cff;
        }
        input[type="file"]:hover::before {
            border-color: #2b8cff;
        }


        .hidden {
            display: none;
        }

        /* Tab Buttons (Navigation) */
        .tab-buttons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            border-bottom: 2px solid #e0e0e0; /* Streamlined separator */
            padding-bottom: 0.5rem;
        }

        .tab-buttons button {
            flex: 1;
            background-color: transparent; /* Transparent button for steps */
            color: #6c757d; /* Lighter color for inactive steps */
            margin: 0 0.25rem;
            padding: 0.5rem 0.25rem;
            border-bottom: 3px solid transparent; /* Highlight indicator */
            border-radius: 0; /* Remove button radius */
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: none;
            letter-spacing: normal;
        }

        .tab-buttons button:hover {
            background-color: transparent;
            color: #1c1f23;
            box-shadow: none;
        }

        .tab-buttons button.active {
            background-color: transparent;
            color: #2b8cff; /* Active step color */
            border-bottom: 3px solid #2b8cff; /* Solid underline for active tab */
        }
        
        /* Model Selection Buttons */
        #tab1 button {
            background-color: #f0f2f6; /* Neutral background for selection */
            color: #1c1f23;
            border: 1px solid #cfd3da;
            transition: border-color 0.2s, background-color 0.2s;
            padding: 0.7rem 2rem;
            margin: 0 0.5rem;
            text-transform: none;
            letter-spacing: normal;
        }
        #tab1 button:hover {
            background-color: #e8ebf0;
            border-color: #2b8cff;
            box-shadow: none;
        }
        
        #modelChoice {
            font-size: 1rem;
            font-weight: 600;
            color: #2b8cff;
            margin-top: 1rem;
            opacity: 1;
        }
        
        /* Table Styling */
        table {
            width: 100%;
            border-collapse: separate; /* Use separate for rounded corners */
            border-spacing: 0;
            margin-top: 1.5rem;
            border-radius: 0.5rem;
            overflow: hidden; /* Ensures rounded corners are visible */
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        th,
        td {
            padding: 0.75rem;
            text-align: left;
            font-size: 0.95rem;
        }
        
        th {
            background-color: #f7f9fb; /* Light header background */
            color: #1c1f23;
            font-weight: 600;
            border-bottom: 1px solid #e0e0e0;
        }
        
        td {
            background-color: #ffffff;
            border-bottom: 1px solid #e9ecef;
        }
        
        tr:last-child td {
            border-bottom: none; /* No border on the last row */
        }

        /* Dashboard specific styles */
        #tab3 p {
            margin: 0.75rem 0;
            text-align: left;
            padding-left: 1rem;
            font-size: 1.1rem;
        }
        #tab3 strong {
            color: #2b8cff;
            font-weight: 700;
            font-size: 1.2rem;
        }
        
        canvas {
            margin-top: 2rem;
            background: #ffffff;
            border-radius: 0.5rem;
            border: 1px solid #e0e0e0;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

    <div class="card">
        <div class="tab-buttons">
            <button class="tab-btn active" onclick="showTab(0)">1. Upload</button>
            <button class="tab-btn" onclick="showTab(1)">2. Model</button>
            <button class="tab-btn" onclick="showTab(2)">3. Transform</button>
            <button class="tab-btn" onclick="showTab(3)">4. Dashboard</button>
        </div>

        <div class="tab" id="tab0">
            <h2>Upload Your CSV Data</h2>
            <input type="file" accept=".csv" />
            <button onclick="showTab(1)">Next Step</button>
        </div>

        <div class="tab hidden" id="tab1">
            <h2>Select Prediction Model</h2>
            <button onclick="selectModel('GRU')">GRU</button>
            <button onclick="selectModel('LSTM')">LSTM</button>
            <p id="modelChoice" style="margin-top:1.5rem;">No model selected.</p>
            <button onclick="showTab(2)">Process Data</button>
        </div>

        <div class="tab hidden" id="tab2">
            <h2>Data Imputation Preview</h2>
            <table>
                <tr><th>Input Value</th><th>Imputed Value</th></tr>
                <tr><td>NaN (Missing)</td><td>23.4</td></tr>
                <tr><td>56.7</td><td>56.7</td></tr>
                <tr><td>(Empty String)</td><td>45.1</td></tr>
            </table>
            <button onclick="showTab(3)">View Dashboard</button>
        </div>

        <div class="tab hidden" id="tab3">
            <h2>Prediction Dashboard</h2>
            <p>Current Solar Panel Reading: <strong>82.4%</strong></p>
            <p>Predicted Peak Efficiency: <strong>91.2%</strong></p>
            <canvas id="chart" width="400" height="200"></canvas>
            <button onclick="showTab(0)">Restart Workflow</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const tabs = document.querySelectorAll('.tab');
        const buttons = document.querySelectorAll('.tab-btn');
        let currentModel = null;

        // Function to control tab visibility
        function showTab(index) {
            tabs.forEach(t => t.classList.add('hidden'));
            tabs[index].classList.remove('hidden');
            buttons.forEach(b => b.classList.remove('active'));
            buttons[index].classList.add('active');
            
            // Re-render chart when dashboard tab is shown
            if (index === 3) {
                 if (window.myChart) window.myChart.update();
            }
        }

        // Function to select and display the model choice
        function selectModel(name) {
            currentModel = name;
            document.getElementById('modelChoice').innerText = "Selected Model: " + name + " (Hybrid GRU-LSTM)";
            // Add visual cue for selected button (optional)
            document.querySelectorAll('#tab1 button').forEach(btn => {
                btn.style.backgroundColor = '#f0f2f6';
                btn.style.borderColor = '#cfd3da';
            });
            event.target.style.backgroundColor = '#2b8cff';
            event.target.style.borderColor = '#2b8cff';
            event.target.style.color = 'white';
        }

        // Dummy Chart Setup
        const ctx = document.getElementById('chart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['1PM', '2PM', '3PM', '4PM', '5PM', '6PM'],
                datasets: [{
                    label: 'Solar Panel Output (W)',
                    data: [400, 420, 415, 440, 460, 430],
                    borderColor: '#2b8cff', // Use the new primary color
                    backgroundColor: 'rgba(43, 140, 255, 0.1)',
                    borderWidth: 2,
                    pointRadius: 4,
                    pointBackgroundColor: '#2b8cff',
                    tension: 0.4, // Smoother line
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            color: '#1c1f23', // Darker legend text
                            font: { family: 'Inter', weight: '600' }
                        }
                    },
                    title: {
                        display: false,
                    }
                },
                scales: {
                    x: {
                        ticks: { color: '#6c757d', font: { family: 'Inter' } },
                        grid: { color: '#e0e0e0', drawOnChartArea: true, drawTicks: false }
                    },
                    y: {
                        ticks: { color: '#6c757d', font: { family: 'Inter' } },
                        grid: { color: '#e0e0e0', drawOnChartArea: true, drawTicks: false }
                    }
                }
            }
        });
        window.myChart = chart;
        
        // Initial setup for the file input to show placeholder text
        document.querySelector('input[type="file"]').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'Select or Drag & Drop CSV file';
            e.target.style.setProperty('--file-name', "'" + fileName + "'");
            e.target.setAttribute('data-file-name', fileName);
        });
    </script>

</body>
</html>
