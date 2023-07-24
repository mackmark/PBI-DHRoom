function chart(){
    
    const ctx = document.getElementById('myChart');

    // Temperature and relative humidity data (example values)
  var timeData = ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00']; // Example time values
  var temperatureData = [20, 22, 24, 25, 23, 21];
  var humidityData = [50, 55, 60, 58, 52, 48];

  var chart = new Chart(ctx, {
        type: 'line',
        data: {
        labels: timeData,
        datasets: [
            {
              label: 'Temperature (°C)',
              data: temperatureData,
              borderColor: 'red',
              fill: false
            },
            {
              label: 'Relative Humidity (%)',
              data: humidityData,
              borderColor: 'blue',
              fill: false
            }
          ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
              x: {
                display: true,
                title: {
                  display: true,
                  text: 'Time'
                }
              },
              y: {
                beginAtZero: true,
                title: {
                  display: true,
                  text: 'Value'
                },
                ticks: {
                    stepSize: 5 // Set the step value to 5
                  }
              }
            }
          },
          elements: {
            line: {
              borderCapStyle: 'round' // Set the line's border cap style to round
            }
          }
    });
}

function refreshChart() {
    chart.update();
  }