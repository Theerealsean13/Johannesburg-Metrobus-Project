from flask import Flask, jsonify, request
import random
import datetime

app = Flask(__name__)

@app.route('/predict_delay', methods=['GET'])
def predict_delay():
    route_id = request.args.get('route_id', type=int)

    if not route_id:
        return jsonify({'error': 'Route ID is required'}), 400

    # Mock delay prediction based on route
    # In a real system, this would use ML models with historical data
    base_delays = {
        1: 5,  # Route 1: 5 minutes average delay
        2: 10, # Route 2: 10 minutes average delay
        3: 0   # Route 3: On time
    }

    base_delay = base_delays.get(route_id, 5)

    # Add some randomness to simulate real predictions
    predicted_delay = max(0, base_delay + random.randint(-5, 10))

    # Current time + predicted delay
    current_time = datetime.datetime.now()
    predicted_arrival = current_time + datetime.timedelta(minutes=predicted_delay)

    return jsonify({
        'route_id': route_id,
        'predicted_delay_minutes': predicted_delay,
        'predicted_arrival_time': predicted_arrival.strftime('%H:%M'),
        'confidence': random.uniform(0.7, 0.95)  # Mock confidence score
    })

@app.route('/route_recommendation', methods=['GET'])
def route_recommendation():
    start = request.args.get('start')
    end = request.args.get('end')

    if not start or not end:
        return jsonify({'error': 'Start and end locations are required'}), 400

    # Mock route recommendations
    recommendations = [
        {
            'route': 'Route 1',
            'duration': 60,
            'transfers': 0,
            'reliability_score': 0.9,
            'reason': 'Direct route with high reliability'
        },
        {
            'route': 'Route 2 + Route 3',
            'duration': 75,
            'transfers': 1,
            'reliability_score': 0.8,
            'reason': 'Alternative with transfer, slightly longer but less crowded'
        }
    ]

    return jsonify({
        'start': start,
        'end': end,
        'recommendations': recommendations
    })

if __name__ == '__main__':
    app.run(debug=True, port=5000)